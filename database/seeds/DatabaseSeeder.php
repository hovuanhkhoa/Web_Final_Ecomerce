<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        Model::unguard();

        $toDay = \Carbon\Carbon::now();

        $customer = ['ID' => 1,
            'Customer_name' => 'Admin',
            'Identify_number' => '025358154',
            'Phone' => '0932273448',
            'Email' => 'hovuanhkhoa@gmail.com',
            'Address' => 'HOME',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];

        $user = ['ID' => 1,
            'ID_CUSTOMER' => 1,
            'Username' => 'admin',
            'Password' => bcrypt('123456789Aa'),
            'ID_ROLE' => 1,
            'created_at' => $toDay,
            'updated_at' => $toDay

        ];


        $roleUser = ['ID' => 2,
            'Role_name' => 'user',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];

        $roleAdmin = ['ID' => 1,
            'Role_name' => 'admin',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];



        DB::table('roles')->insert($roleAdmin);



        DB::table('roles')->insert($roleUser);

        DB::table('customers')->insert($customer);

        DB::table('users')->insert($user);

        $tag = ['ID' => 1,
            'Tag_name' => 'Mới',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('tags')->insert($tag);

        $tag = ['ID' => 2,
            'Tag_name' => 'Apple',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('tags')->insert($tag);

        $tag = ['ID' => 3,
            'Tag_name' => 'Samsung',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('tags')->insert($tag);

        $tag = ['ID' => 4,
            'Tag_name' => 'Asus',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('tags')->insert($tag);

        $tag = ['ID' => 5,
            'Tag_name' => 'Hot',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('tags')->insert($tag);

        $tag = ['ID' => 6,
            'Tag_name' => 'Phụ kiện',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('tags')->insert($tag);

        $tag = ['ID' => 7,
            'Tag_name' => 'Sản phẩm chính',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('tags')->insert($tag);

        $tag = ['ID' => 8,
            'Tag_name' => 'Tai nghe 3.5mm',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('tags')->insert($tag);

        $tag = ['ID' => 9,
            'Tag_name' => 'Thẻ nhớ',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('tags')->insert($tag);

        $tag = ['ID' => 10,
            'Tag_name' => 'Ốp lưng',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('tags')->insert($tag);

        $tag = ['ID' => 11,
            'Tag_name' => 'Chuột USB',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('tags')->insert($tag);

        $tag = ['ID' => 12,
            'Tag_name' => 'USB',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('tags')->insert($tag);


        $category = ['ID' => 1,
            'Category_name' => 'Phone',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('categories')->insert($category);

        $category = ['ID' => 2,
            'Category_name' => 'Tablet',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('categories')->insert($category);

        $category = ['ID' => 3,
            'Category_name' => 'Laptop',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('categories')->insert($category);

        $category = ['ID' => 4,
            'Category_name' => 'Flashdisk',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('categories')->insert($category);

        $category = ['ID' => 5,
            'Category_name' => 'Headphone',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('categories')->insert($category);

        $category = ['ID' => 6,
            'Category_name' => 'Connector',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('categories')->insert($category);

        $category = ['ID' => 7,
            'Category_name' => 'Case',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('categories')->insert($category);

        $category = ['ID' => 8,
            'Category_name' => 'USB',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('categories')->insert($category);

        $category = ['ID' => 9,
            'Category_name' => 'Mouse',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('categories')->insert($category);


        $maker = ['ID' => 1,
            'Maker_name' => 'Apple',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('makers')->insert($maker);

        $maker = ['ID' => 2,
            'Maker_name' => 'Kington',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('makers')->insert($maker);

        $maker = ['ID' => 3,
            'Maker_name' => 'Samsung',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('makers')->insert($maker);

        $maker = ['ID' => 4,
            'Maker_name' => 'Asus',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('makers')->insert($maker);

        $maker = ['ID' => 5,
            'Maker_name' => 'None',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('makers')->insert($maker);

        $maker = ['ID' => 6,
            'Maker_name' => 'Dell',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('makers')->insert($maker);

        $mediaSet = ['ID' => 1,
            'Media_name' => '1_Feature',
            'Link' => 'https://cdn4.tgdd.vn/Products/Images/42/74110/iphone-7-bac-anh-dai-org-dien.png',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);

        $mediaSet = ['ID' => 2,
            'Media_name' => '1_Black',
            'Link' => 'https://cdn.tgdd.vn/Products/Images/42/74110/iphone-7-den-anh-dai-org-dien.png',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);

        $mediaSet = ['ID' => 3,
            'Media_name' => '1_White',
            'Link' => 'https://cdn4.tgdd.vn/Products/Images/42/74110/iphone-7-bac-anh-dai-org-dien.png',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);

        $mediaSet = ['ID' => 4,
            'Media_name' => '1_YELLOW',
            'Link' => 'https://cdn3.tgdd.vn/Products/Images/42/74110/iphone-7-vang-dong-anh-dai-org-dien.png',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 1,
            'ID_CATEGORY' => 1,
            'ID_MAKER' => 1,
            'Product_name' => 'iPhone 7 32GB',
            'Detail' => '{"screenSize":"4.7","screenDetails":"LED-backlit","os":"iOS 10","frontCameraRes":7,"backCameraRes":12,"cpu":"Apple A10 Fusion 4 nhân 64-bit","ram":2,"internalMemSize":32,"externalDiskSupported":false,"sim":"1 Nano SIM","pinCapacity":1960,"charge":"Lightning","connect":"Wifi, 3G, 4G, bluetooth","headphone":"none","weight":138}',
            'Media_set' => 'Feature,Black,White,Yellow',
            'Price' => 18790000,
            'Quantity' => 350,
            'ID_TAG' => '1,2,5,7',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);

        $mediaSet = ['ID' => 5,
            'Media_name' => '2_Feature',
            'Link' => 'https://cdn4.tgdd.vn/Products/Images/42/74110/iphone-7-bac-anh-dai-org-dien.png',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);

        $mediaSet = ['ID' => 6,
            'Media_name' => '2_Black',
            'Link' => 'https://cdn.tgdd.vn/Products/Images/42/74110/iphone-7-den-anh-dai-org-dien.png',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);

        $mediaSet = ['ID' => 7,
            'Media_name' => '2_White',
            'Link' => 'https://cdn4.tgdd.vn/Products/Images/42/74110/iphone-7-bac-anh-dai-org-dien.png',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);

        $mediaSet = ['ID' => 8,
            'Media_name' => '2_YELLOW',
            'Link' => 'https://cdn3.tgdd.vn/Products/Images/42/74110/iphone-7-vang-dong-anh-dai-org-dien.png',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 2,
            'ID_CATEGORY' => 1,
            'ID_MAKER' => 1,
            'Product_name' => 'iPhone 7 128GB',
            'Detail' => '{"screenSize":"5.5","screenDetails":"LED-backlit","os":"iOS 10","frontCameraRes":7,"backCameraRes":12,"cpu":"Apple A10 Fusion 4 nhân 64-bit","ram":3,"internalMemSize":128,"externalDiskSupported":false,"sim":"1 Nano SIM","pinCapacity":2900,"charge":"Lightning","connect":"Wifi, 3G, 4G, bluetooth","headphone":"none","weight":188}',
            'Media_set' => 'Feature,Black,White,Yellow',
            'Price' => 25190000,
            'Quantity' => 200,
            'ID_TAG' => '1,2,5,7',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);

        $mediaSet = ['ID' => 9,
            'Media_name' => '3_Feature',
            'Link' => 'https://cdn4.tgdd.vn/Products/Images/42/88540/samsung-galaxy-s7-edge-blue-coral-1-org-edition.png',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);



        $product = ['ID' => 3,
            'ID_CATEGORY' => 1,
            'ID_MAKER' => 3,
            'Product_name' => 'Samsung Galaxy S7 Edge',
            'Detail' => '{"screenSize":"5.5","screenDetails":"Super AMOLED","os":"Android 6.0","frontCameraRes":5,"backCameraRes":12,"cpu":"Exynos 8890 8 nhân 64-bit","ram":4,"internalMemSize":32,"externalDiskSupported":true,"sim":"2 Nano SIM","pinCapacity":3600,"charge":"Micro USB","connect":"Wifi, 3G, 4G, bluetooth","headphone":"3.5mm","weight":157}',
            'Media_set' => 'Feature',
            'Price' => 18490000,
            'Quantity' => 200,
            'ID_TAG' => '1,3,5,7,8,9,10',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);


        $mediaSet = ['ID' => 10,
            'Media_name' => '4_Feature',
            'Link' => 'https://cdn.tgdd.vn/Products/Images/522/73088/ipad-pro-wifi-32gb-bac-org-1.png',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 4,
            'ID_CATEGORY' => 2,
            'ID_MAKER' => 1,
            'Product_name' => 'iPad Pro Wifi 32GB',
            'Detail' => '{"screenSize":"12.9","screenDetails":"LED backlit LCD","os":"iOS 9","frontCameraRes":8,"backCameraRes":2,"cpu":"Apple A9X 2 nhân 64-bit","ram":4,"internalMemSize":32,"externalDiskSupported":false,"sim":"0","pinCapacity":10300,"charge":"Lightning","connect":"Wifi, bluetooth","headphone":"3.5mm","weight":713}',
            'Media_set' => 'Feature',
            'Price' => 17990000,
            'Quantity' => 200,
            'ID_TAG' => '1,2,5,7,8',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);

        $mediaSet = ['ID' => 11,
            'Media_name' => '5_Feature',
            'Link' => 'https://cdn.tgdd.vn/Products/Images/522/73088/ipad-pro-wifi-32gb-bac-org-1.png',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 5,
            'ID_CATEGORY' => 2,
            'ID_MAKER' => 1,
            'Product_name' => 'iPad Pro Wifi 64GB',
            'Detail' => '{"screenSize":"12.9","screenDetails":"LED backlit LCD","os":"iOS 9","frontCameraRes":8,"backCameraRes":2,"cpu":"Apple A9X 2 nhân 64-bit","ram":4,"internalMemSize":64,"externalDiskSupported":false,"sim":"0","pinCapacity":10300,"charge":"Lightning","connect":"Wifi, bluetooth","headphone":"3.5mm","weight":713}',
            'Media_set' => 'Feature',
            'Price' => 20990000,
            'Quantity' => 200,
            'ID_TAG' => '1,2,5,7,8',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);

        $mediaSet = ['ID' => 12,
            'Media_name' => '6_Feature',
            'Link' => 'https://cdn4.tgdd.vn/Products/Images/522/87306/samsung-galaxy-tab-a6-101-1-org-spen.png',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 6,
            'ID_CATEGORY' => 2,
            'ID_MAKER' => 3,
            'Product_name' => 'Samsung Galaxy Tab A6 10.1',
            'Detail' => '{"screenSize":"10.1","screenDetails":"PLS LCD","os":"Android 6.0","frontCameraRes":2,"backCameraRes":8,"cpu":"Exynos 7870 8 nhân","ram":3,"internalMemSize":16,"externalDiskSupported":true,"sim":"1 Nano Sim","pinCapacity":7300,"charge":"Micro USB","connect":"Wifi, 3G, 4G, bluetooth","headphone":"3.5mm","weight":560}',
            'Media_set' => 'Feature',
            'Price' => 8990000,
            'Quantity' => 200,
            'ID_TAG' => '1,3,5,7,8,9',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);


        $mediaSet = ['ID' => 13,
            'Media_name' => '7_Feature',
            'Link' => 'https://cdn4.tgdd.vn/Products/Images/44/82537/apple-macbook-12-mlhf2-core-m-12g-8gb-512gb-1-org-macos.png',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 7,
            'ID_CATEGORY' => 3,
            'ID_MAKER' => 1,
            'Product_name' => 'Apple Macbook 12" MLHF2',
            'Detail' => '{"screenSize":"12","screenDetails":"Retina","mainboard":"Intel HM Series Express Chipset","cpu":"Intel Core M 1.20GHz","ram":8,"hddSize":512,"graphicCard":"Intel HD Graphics 515","webcam":1.3,"pinCapacity":4,"hasTouchScreen":false,"hasOpticalDrive":false,"connect":"USB 2.0, USB 3.0","weight":1}',
            'Media_set' => 'Feature',
            'Price' => 37990000,
            'Quantity' => 200,
            'ID_TAG' => '1,2,5,7,11,12',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);

        $mediaSet = ['ID' => 14,
            'Media_name' => '8_Feature',
            'Link' => 'https://cdn2.tgdd.vn/Products/Images/44/86323/asus-a456ua-wx034t-vang-2-org-1.jpg',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 8,
            'ID_CATEGORY' => 3,
            'ID_MAKER' => 4,
            'Product_name' => 'Asus A456UA',
            'Detail' => '{"screenSize":"14","screenDetails":"HD","mainboard":"Intel HM8 Series Express Chipsett","cpu":"Intel Core i5 Skylake 2.30 GHz","ram":4,"hddSize":500,"graphicCard":"Intel® HD Graphics 520","webcam":0.3,"pinCapacity":4,"hasTouchScreen":false,"hasOpticalDrive":false,"connect":"HDMI, LAN (RJ45), USB 2.0, USB 3.0, VGA","weight":2}',
            'Media_set' => 'Feature',
            'Price' => 12490000,
            'Quantity' => 250,
            'ID_TAG' => '1,4,5,7,8,11,12',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);

        $mediaSet = ['ID' => 15,
            'Media_name' => '9_Feature',
            'Link' => 'https://cdn2.tgdd.vn/Products/Images/44/86323/asus-a456ua-wx034t-vang-2-org-1.jpg',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 9,
            'ID_CATEGORY' => 3,
            'ID_MAKER' => 4,
            'Product_name' => 'Asus A456UARA',
            'Detail' => '{"screenSize":"14","screenDetails":"HD","mainboard":"Intel HM8 Series Express Chipsett","cpu":"Intel Core i5 Skylake 2.30 GHz","ram":8,"hddSize":1000,"graphicCard":"Intel® HD Graphics 520","webcam":0.3,"pinCapacity":6,"hasTouchScreen":false,"hasOpticalDrive":false,"connect":"HDMI, LAN (RJ45), USB 2.0, USB 3.0, VGA","weight":2}',
            'Media_set' => 'Feature',
            'Price' => 14490000,
            'Quantity' => 250,
            'ID_TAG' => '1,4,5,7,8,11,12',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);

        $mediaSet = ['ID' => 16,
            'Media_name' => '10_Feature',
            'Link' => 'https://cdn3.tgdd.vn/Products/Images/55/69973/the-nho-microsd-16gb-class-10-7-300x300.jpg',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 10,
            'ID_CATEGORY' => 4,
            'ID_MAKER' => 5,
            'Product_name' => '16Gb MicroSD class 10',
            'Detail' => '{"type":"MicroSD","size":16,"readSpeed":30,"writeSpeed":30}',
            'Media_set' => 'Feature',
            'Price' => 190000,
            'Quantity' => 450,
            'ID_TAG' => '1,5,6,9',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);

        $mediaSet = ['ID' => 17,
            'Media_name' => '11_Feature',
            'Link' => 'https://cdn3.tgdd.vn/Products/Images/55/69973/the-nho-microsd-16gb-class-10-7-300x300.jpg',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 11,
            'ID_CATEGORY' => 4,
            'ID_MAKER' => 5,
            'Product_name' => '32Gb MicroSD class 10',
            'Detail' => '{"type":"MicroSD","size":32,"readSpeed":30,"writeSpeed":30}',
            'Media_set' => 'Feature',
            'Price' => 400000,
            'Quantity' => 450,
            'ID_TAG' => '1,5,6,9',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);

        $mediaSet = ['ID' => 18,
            'Media_name' => '12_Feature',
            'Link' => 'https://cdn3.tgdd.vn/Products/Images/55/69973/the-nho-microsd-16gb-class-10-7-300x300.jpg',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 12,
            'ID_CATEGORY' => 4,
            'ID_MAKER' => 5,
            'Product_name' => '64Gb MicroSD class 10',
            'Detail' => '{"type":"MicroSD","size":64,"readSpeed":30,"writeSpeed":30}',
            'Media_set' => 'Feature',
            'Price' => 750000,
            'Quantity' => 450,
            'ID_TAG' => '1,5,6,9',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);



        $mediaSet = ['ID' => 19,
        'Media_name' => '13_Feature',
        'Link' => 'https://cdn3.tgdd.vn/Products/Images/54/79638/tai-nghe-chup-tai-sony-mdr-zx310aprce-do-300x300.jpg',
            'created_at' => $toDay,
            'updated_at' => $toDay
    ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 13,
            'ID_CATEGORY' => 5,
            'ID_MAKER' => 5,
            'Product_name' => 'Sony MDR - ZX310APRCE',
            'Detail' => '{"connect":"3.5 mm","type":"Tai nghe có dây","featureButton":"Mic, nghe/nhận cuộc gọi, phát/dừng nhạc"}',
            'Media_set' => 'Feature',
            'Price' => 890000,
            'Quantity' => 450,
            'ID_TAG' => '1,5,6,8',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);

        $mediaSet = ['ID' => 20,
            'Media_name' => '14_Feature',
            'Link' => 'https://cdn4.tgdd.vn/Products/Images/54/89319/tai-nghe-chup-tai-kanen-jk2-anh-dai-dien-300x300.jpg',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 14,
            'ID_CATEGORY' => 5,
            'ID_MAKER' => 5,
            'Product_name' => 'Kanen JK2',
            'Detail' => '{"connect":"3.5 mm","type":"Tai nghe có dây","featureButton":"Mic, nghe/nhận cuộc gọi, phát/dừng nhạc"}',
            'Media_set' => 'Feature',
            'Price' => 400000,
            'Quantity' => 450,
            'ID_TAG' => '1,5,6,8',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);


        $mediaSet = ['ID' => 21,
            'Media_name' => '15_Feature',
            'Link' => 'https://cdn4.tgdd.vn/Products/Images/54/89319/tai-nghe-chup-tai-kanen-jk2-anh-dai-dien-300x300.jpg',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 15,
            'ID_CATEGORY' => 5,
            'ID_MAKER' => 5,
            'Product_name' => 'Cliptec Urban Clubz BMH833',
            'Detail' => '{"connect":"3.5 mm","type":"Tai nghe có dây","featureButton":"Mic, nghe/nhận cuộc gọi, phát/dừng nhạc"}',
            'Media_set' => 'Feature',
            'Price' => 350000,
            'Quantity' => 450,
            'ID_TAG' => '1,5,6,8',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);



        $mediaSet = ['ID' => 22,
            'Media_name' => '16_Feature',
            'Link' => 'https://cdn.tgdd.vn/Products/Images/58/79079/cap-micro-usb-20cm-esaver-bst-0728-trang-km-808x499.png',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 16,
            'ID_CATEGORY' => 6,
            'ID_MAKER' => 5,
            'Product_name' => 'USB 20cm eSaver BST-0728',
            'Detail' => '{"type":"Micro USB","input":"5V - 2.4A max","output":"5V - 2.4A max","length":20}',
            'Media_set' => 'Feature',
            'Price' => 40000,
            'Quantity' => 450,
            'ID_TAG' => '1,5,6',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);



        $mediaSet = ['ID' => 23,
            'Media_name' => '17_Feature',
            'Link' => 'https://cdn.tgdd.vn/Products/Images/58/77890/cap-micro-usb-50cm-x-mobile-mu03-avatar-300x300.jpg',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 17,
            'ID_CATEGORY' => 6,
            'ID_MAKER' => 5,
            'Product_name' => 'USB 50cm X Mobile MU03',
            'Detail' => '{"type":"Micro USB","input":"5V - 2A max","output":"5V - 2A max","length":50}',
            'Media_set' => 'Feature',
            'Price' => 40000,
            'Quantity' => 450,
            'ID_TAG' => '1,5,6',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);

        $mediaSet = ['ID' => 24,
            'Media_name' => '18_Feature',
            'Link' => 'https://cdn.tgdd.vn/Products/Images/58/77890/cap-micro-usb-50cm-x-mobile-mu03-avatar-300x300.jpg',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 18,
            'ID_CATEGORY' => 6,
            'ID_MAKER' => 5,
            'Product_name' => 'USB 100cm X Mobile MU03',
            'Detail' => '{"type":"Micro USB","input":"5V - 2A max","output":"5V - 2A max","length":100}',
            'Media_set' => 'Feature',
            'Price' => 50000,
            'Quantity' => 450,
            'ID_TAG' => '1,5,6',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);


        $mediaSet = ['ID' => 25,
            'Media_name' => '19_Feature',
            'Link' => 'https://cdn4.tgdd.vn/Products/Images/60/78491/op-lung-galaxy-j5-2016-nhua-deo-x-mobile-la-tim-org-1.jpg',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 19,
            'ID_CATEGORY' => 7,
            'ID_MAKER' => 5,
            'Product_name' => 'Galaxy J5',
            'Detail' => '{"material":"Nhựa dẻo"}',
            'Media_set' => 'Feature',
            'Price' => 50000,
            'Quantity' => 450,
            'ID_TAG' => '1,5,6,10',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);

        $mediaSet = ['ID' => 26,
            'Media_name' => '20_Feature',
            'Link' => 'https://cdn4.tgdd.vn/Products/Images/60/74648/op-lung-galaxy-j2-nhua-deo-day-bong-co-gai-nau-org-1.jpg',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 20,
            'ID_CATEGORY' => 7,
            'ID_MAKER' => 5,
            'Product_name' => 'Galaxy J2 Nhựa dẻo dày bóng Cô gái Nâu',
            'Detail' => '{"material":"Nhựa dẻo"}',
            'Media_set' => 'Feature',
            'Price' => 70000,
            'Quantity' => 450,
            'ID_TAG' => '1,5,6,10',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);

        $mediaSet = ['ID' => 27,
            'Media_name' => '21_Feature',
            'Link' => 'https://cdn4.tgdd.vn/Products/Images/60/74427/op-lung-galaxy-j5-nhua-deo-day-bong-co-gai-do-org-1.jpg',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 21,
            'ID_CATEGORY' => 7,
            'ID_MAKER' => 5,
            'Product_name' => 'Galaxy J7 Nhựa dẻo dày bóng Cô gái Đỏ',
            'Detail' => '{"material":"Nhựa dẻo"}',
            'Media_set' => 'Feature',
            'Price' => 80000,
            'Quantity' => 350,
            'ID_TAG' => '1,5,6,10',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);


        $mediaSet = ['ID' => 28,
            'Media_name' => '22_Feature',
            'Link' => 'https://cdn.tgdd.vn/Products/Images/75/73981/usb-8gb-20-apacer-ah112-1-808x449-808x449.png',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 22,
            'ID_CATEGORY' => 8,
            'ID_MAKER' => 5,
            'Product_name' => 'USB 2.0 8GB Apacer AH112',
            'Detail' => '{"size":8,"type":"USB 2.0","readSpeed":20,"writeSpeed":5}',
            'Media_set' => 'Feature',
            'Price' => 120000,
            'Quantity' => 350,
            'ID_TAG' => '1,5,6,12',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);



        $mediaSet = ['ID' => 29,
            'Media_name' => '23_Feature',
            'Link' => 'https://cdn.tgdd.vn/Products/Images/75/73981/usb-8gb-20-apacer-ah112-1-808x449-808x449.png',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 23,
            'ID_CATEGORY' => 8,
            'ID_MAKER' => 5,
            'Product_name' => 'USB 2.0 4GB Apacer AH112',
            'Detail' => '{"size":4,"type":"USB 2.0","readSpeed":20,"writeSpeed":5}',
            'Media_set' => 'Feature',
            'Price' => 80000,
            'Quantity' => 350,
            'ID_TAG' => '1,5,6,12',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);


        $mediaSet = ['ID' => 30,
            'Media_name' => '24_Feature',
            'Link' => 'https://cdn.tgdd.vn/Products/Images/75/73981/usb-8gb-20-apacer-ah112-1-808x449-808x449.png',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 24,
            'ID_CATEGORY' => 8,
            'ID_MAKER' => 5,
            'Product_name' => 'USB 2.0 16GB Apacer AH112',
            'Detail' => '{"size":16,"type":"USB 2.0","readSpeed":20,"writeSpeed":5}',
            'Media_set' => 'Feature',
            'Price' => 200000,
            'Quantity' => 350,
            'ID_TAG' => '1,5,6,12',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);


        $mediaSet = ['ID' => 31,
            'Media_name' => '25_Feature',
            'Link' => 'https://cdn2.tgdd.vn/Products/Images/86/82812/chuot-co-day-zadez-m168-den-bac-300x300.jpg',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 25,
            'ID_CATEGORY' => 9,
            'ID_MAKER' => 5,
            'Product_name' => 'Zadez M168 Đen bạc',
            'Detail' => '{"type":"Chuột có dây","dpi":1000,"connect":"USB"}',
            'Media_set' => 'Feature',
            'Price' => 80000,
            'Quantity' => 350,
            'ID_TAG' => '1,5,6,11',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);


        $mediaSet = ['ID' => 32,
            'Media_name' => '26_Feature',
            'Link' => 'https://cdn.tgdd.vn/Products/Images/86/74786/chuot-co-day-zadez-m116-1-den-300x300.png',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('media')->insert($mediaSet);


        $product = ['ID' => 26,
            'ID_CATEGORY' => 9,
            'ID_MAKER' => 5,
            'Product_name' => 'Zadez M116 Đen',
            'Detail' => '{"type":"Chuột có dây","dpi":1000,"connect":"USB"}',
            'Media_set' => 'Feature',
            'Price' => 100000,
            'Quantity' => 250,
            'ID_TAG' => '1,5,6,11',
            'created_at' => $toDay,
            'updated_at' => $toDay
        ];
        DB::table('products')->insert($product);

    }
}
