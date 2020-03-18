<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	/*role*/
    	$array_roles = array('Admin', 'Reviewers','Business');
        foreach ($array_roles as $role)
        {
            DB::table('roles')->insert([
                'name'      => $role,
                'display_name'   => str_replace('-', ' ', $role),
            ]);
        }
        /*user*/
        $faker = Faker::create();
        $role_ids = DB::table('roles')->pluck('id');
        $i= 1;
        DB::table('users')->insert([
                'email'      => 'admin@gmail.com',
                'email_verified_at'   => '2019-10-24 00:00:00',
                'password' => '$2y$10$APz68RDFMrofYkhTOzsTn.UfTj0O108kaO1EA1UyAWjK4tblKxoNa',
                'name' => 'admin',
                'role_id' => 1,
                'created_at' => now(),
            ]);  
        for ($i=1; $i < 20 ; $i++) { 
        	 DB::table('users')->insert([
                'email'      => 'demo'.$i.'@gmail.com',
                'email_verified_at'   => '2019-10-24 00:00:00',
                'password' => '$2y$10$APz68RDFMrofYkhTOzsTn.UfTj0O108kaO1EA1UyAWjK4tblKxoNa',
                'name' => 'demo'.$i,
                'role_id' => 2,
                'created_at' => now(),
            ]);
        }
        for ($i=1; $i < 20 ; $i++) { 
             DB::table('users')->insert([
                'email'      => 'business'.$i.'@gmail.com',
                'email_verified_at'   => '2019-10-24 00:00:00',
                'password' => '$2y$10$APz68RDFMrofYkhTOzsTn.UfTj0O108kaO1EA1UyAWjK4tblKxoNa',
                'name' => 'business'.$i,
                'role_id' => 3,
                'created_at' => now(),
            ]);
        }
        $arr_user_business = DB::table('users')->where('role_id','=',3)->pluck('id');
        // $this->call(UsersTableSeeder::class);
        /*category*/
        $array_category = array('Pizza', 'Fried Chicken','Burgers','Steaks','Salmon','Spaghetti','Salmon','Spaghetti');
        foreach ($array_category as $cate)
        {
            DB::table('categories')->insert([
                'category_name'      => $cate,
                'description'   => $cate,
            ]);
        }
        $arr_id_cate = [1,2,3,4,5,6,7,8];
        /*location*/
        for ($i=1; $i < 20 ; $i++) {
            DB::table('locations')->insert([
                [
                    'address' => 'SN99, Phố, Nguyễn Công Hoan, Đồng Quang, Thành phố Thái Nguyên, Thái Nguyên, Việt Nam',
                    'latitude' => 21.581045,
                    'longitude' => 105.832940,
                    'state' => 'Thái Nguyên',
                    'country' => 'Việt Nam',
                    'city' => 'Thành phố Thái Nguyên',
                    'code' => 01,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
        /*businesses*/
        $location_business = 1;
         foreach ($arr_user_business as $user_business)
        {
            DB::table('businesses')->insert([
                'name'      => 'business'.$user_business,
                'email'   => 'business'.$user_business.'@gmail.com',
                'user_id' => $user_business,
                'description' => 'business'.$user_business,
                'location_id' => $location_business,
                'address' => 'SN99, Phố, Nguyễn Công Hoan, Đồng Quang, Thành phố Thái Nguyên, Thái Nguyên, Việt Nam',
            ]);
            $location_business ++;
        }
        $arr_business_id = DB::table('businesses')->pluck('id');
        /*businesses_categories*/
         foreach ($arr_business_id as $business_id)
        {
            DB::table('businesses_categories')->insert([
                'business_id'      => $business_id,
                'cate_id'   => Arr::random($arr_id_cate),
            ]);
        }
        /*payment_plans*/
        $array_payment_plans = array('paytohome', 'searcheatscity','searcheatscounty','searcheatsstate','featureeatscity','featureeatscounty','featureeatsstate');
        foreach ($array_payment_plans as $name)
        {
            DB::table('payment_plans')->insert([
                'name'      => $name,
            ]);
        }
        /*plan_details*/
         $plans_ids = DB::table('payment_plans')->pluck('id');
         foreach ($plans_ids as $plan_id)
         {
            DB::table('plan_details')->insert([
                'pd_plan_id'      => $plan_id,
                'pd_days' => 30,
                'pd_cost' => 10.99,

            ]);
            DB::table('plan_details')->insert([
                'pd_plan_id'      => $plan_id,
                'pd_days' => 180,
                'pd_cost' => 49.99,
                
            ]);
            DB::table('plan_details')->insert([
                'pd_plan_id'      => $plan_id,
                'pd_days' => 364,
                'pd_cost' => 199.99,
                
            ]);
        }

    }
}

