<?php

use Illuminate\Database\Seeder;

use App\Item;
use App\Item_Shop;
use App\Shop;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $file = new SplFileObject('database/csv/data.csv');
        $file->setFlags(
            \SplFileObject::READ_CSV |   // CSV 列として行を読み込む
            \SplFileObject::READ_AHEAD | // 先読み/(巻き戻し)で読み出す。
            \SplFileObject::SKIP_EMPTY | // 空行は読み飛ばす
            \SplFileObject::DROP_NEW_LINE // 行末の改行を読み飛ばす
        );
        $all_data = [];
        $now = date("Y-m-d H:i:s");

        $lineCount = 1;
        foreach($file as $line) {
            if ($lineCount > 1) { // ヘッダー行はスキップする
                mb_convert_variables('UTF-8', 'sjis-win', $line);
                
                $item_posted = $line[2];
                $shop_posted = $line[0];
                $ten = array('支店','店');
                $branch_posted = str_replace($ten, "", $line[1]);
                $amount_posted = $line[3];
                $yen = array('円','\\','￥', '￥');
                $money_posted = str_replace($yen, "", $line[4]);
                if ($amount_posted && $money_posted) {
                    $cospa = $money_posted / preg_replace('/[^0-9]/', '', $amount_posted);
                } else {
                    $cospa = $money_posted;
                }
                $comment_posted = $line[5];        
                $date_posted = $line[6];

                $all_data[] = [
                    "shop" => $shop_posted,
                    "branch" => $branch_posted,
                    "item" => $item_posted,
                    "amount" => $line[3],
                    "money" => $money_posted,
                    "cospa" => $cospa,
                    "comment" => $line[5],
                    "date" => $line[6],
                    "created_at" => $now,
                    "updated_at" => $now,
                ];

                // itemsの更新
                Item::updateOrCreate(['name'=> $item_posted]);
                $item_added = Item::where('name', $item_posted)->first();

                // shopsの更新
                Shop::updateOrCreate(['name'=> $shop_posted, 'branch'=> $branch_posted]);
                $branch_added = Shop::where('name', $shop_posted)->where('branch', $branch_posted)->first();

                // item_shop
                $item_added->middle()->updateOrcreate(
                    ['item_id' => $item_added->id, 'shop_id' => $branch_added->id]
                );
                $middle_added = Item_Shop::where('item_id', $item_added->id)
                    -> where('shop_id', $branch_added->id) -> first();

                // info
                $middle_added->information()->updateOrcreate(
                    ['amount' => $line[3], 'money' => $money_posted, 'cospa' => $cospa, 'comment' => $line[5], 'date' => $line[6]]
                );
            }
            $lineCount++;
        }

        DB::table("all_datas")->insert($all_data);
    }
}
