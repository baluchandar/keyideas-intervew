<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function import_csv(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = fopen($request->file('file'), 'r');
        if ($file === false) {
            return redirect('dashboard')->with('error_msg','File could not be read.');
        }
        
        fgetcsv($file);//skip header
        $count = 0;
        while (($row = fgetcsv($file)) !== FALSE) {
            $count++;
            $productLiveUrl = str_replace(" ","_",$row[2]).'-'.$row[0];//row[2] is product name
            $productArray = array(
                'prod_sku'=>$row[0],
                'prod_Live_URL'=>$productLiveUrl,
                'prod_name'=>$row[2],
                'prod_long_desc'=>$row[3],
                'prod_type'=>$row[4],
                'prod_subcategory'=>$row[5],
                'prodmeta_section'=>$row[6],
                'prodmeta_ship_days'=>$row[7],
                'prodmeta_metal_weight'=>$row[8],
                'prodmeta_side_diamonds_count'=>$row[9]?:null,
                'prodmeta_side_diamonds_ctw'=>$row[10],
                'prodmeta_side_diamonds_color_clarity'=>$row[11],
                'prodmeta_side_diamonds1_count'=>$row[12]?:null,
                'attr_14k_regular'=>$row[13]?:null,
                'attr_14k_metal_available'=>$row[14],
                'attr_18k_regular'=>$row[15]?:null,
                'attr_18k_metal_available'=>$row[16],
                'attr_platinum_regular'=>$row[17]?:null,
                // 'attr_whitegold_platinum_round_default_img'=>$row[18],
                'attr_whitegold_platinum_round_default_img'=>'images/gallery.jpg',
                // 'attr_whitegold_platinum_round_img'=>$row[19],
                'attr_whitegold_platinum_round_img'=>'images/gallery.jpg',
                // 'attr_rosegold_round_default_img'=>$row[20],
                'attr_rosegold_round_default_img'=>'images/gallery.jpg',
                // 'attr_rosegold_round_img'=>$row[21],
                'attr_rosegold_round_img'=>'images/gallery.jpg',
                'attr_yellowgold_round_default_img'=>'images/gallery.jpg',
                'attr_yellowgold_round_img'=>'images/gallery.jpg',
                'attr_whitegold_yellow_round_default_img'=>'images/gallery.jpg',
                'attr_whitegold_yellow_round_img'=>'images/gallery.jpg',
                'attr_whitegold_rose_round_default_img'=>'images/gallery.jpg',
                'attr_whitegold_rose_round_img'=>'images/gallery.jpg',
                'attr_tricolor_round_default_img'=>'images/gallery.jpg',
                'attr_tricolor_round_img'=>'images/gallery.jpg',
            );
            $product = Product::firstOrCreate(
                ['prod_sku' => $row[0]],
                $productArray
            );

            $catIds = [];
            $category_column = explode(",",$row[5]);
            if($category_column) {
                foreach($category_column as $categoryItem) {
                    $categoryItem = str_replace("Women","",$categoryItem);
                    $categoryItem = str_replace("Men","",$categoryItem);
                    $categoryItem = str_replace("Wedding Band","",$categoryItem);
                    $categoryItem = trim($categoryItem);
                    if($categoryItem) {
                        $cat = Category::firstOrCreate(
                            ['name' => $categoryItem]
                        );
                        $catIds[] = $cat->id;
                    }
                }
            }
            if($catIds && $product) {
                $timestamp = date('Y-m-d H:i:s');
                foreach ($catIds as $categoryId) {
                    if (!$product->categories->contains($categoryId)) {
                        $product->categories()->attach($categoryId, [
                            'created_at' => $timestamp,
                            'updated_at' => $timestamp
                        ]);
                    }
                }
            }
        }//endwhile
        if($count == 0) {
            return redirect('dashboard')->with('error_msg','You are given an empty CSV file.');
        } 

        fclose($file);

        return back()->with('success', 'Products imported successfully.');
    }
}
