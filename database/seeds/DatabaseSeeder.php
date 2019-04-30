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
                $all_data[] = [
                    "shop" => $line[0],
                    "branch" => $line[1],
                    "item" => $line[2],
                    "amount" => $line[3],
                    "money" => $line[4],
                    "comment" => $line[5],
                    "date" => $line[6],
                    "created_at" => $now,
                    "updated_at" => $now,
                ];

                // itemsの更新
                Item::updateOrCreate(['name'=> $line[2]]);
                $item_added = Item::where('name', $line[2])->first();

                // shopsの更新
                Shop::updateOrCreate(['name'=> $line[0], 'branch'=> $line[1]]);
                $branch_added = Shop::where('name', $line[0])->where('branch', $line[1])->first();

                // item_shop
                $item_added->middle()->updateOrcreate(
                    ['item_id' => $item_added->id, 'shop_id' => $branch_added->id]
                );
                $middle_added = Item_Shop::where('item_id', $item_added->id)
                    -> where('shop_id', $branch_added->id) -> first();

                // info
                $middle_added->information()->updateOrcreate(
                    ['amount' => $line[3], 'money' => $line[4], 'comment' => $line[5], 'date' => $line[6]]
                );
            }
            $lineCount++;
        }

        DB::table("all_datas")->insert($all_data);
    }
}
