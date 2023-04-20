<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subscribe;
use App\Models\Subcategory;
use Illuminate\Http\Request;
// use Notification;
use Ramsey\Uuid\Type\Integer;
use App\Http\Requests\UserRequest;
use App\Models\ProductSubcategory;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EmailRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProductRequest;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function view_admin_page(){
        $products_cnt = Product::all()->count();
        $orders_cnt = Order::where('delivery_status', '<>', 'cancelled')->count();
        $customers_cnt = User::where('usertype','=',0)->count();
        $orders = Order::where('delivery_status', '<>', 'cancelled')->get();
        $revenue_tot = 0;
        foreach($orders as $order){
            $revenue_tot+=$order->cart->price;
        }
        $delivered_cnt = Order::where('delivery_status', '=', 'delivered')->count();
        $processing_cnt = Order::where('delivery_status', '=', 'processing')->count();
        $cancelled_cnt = Order::where('delivery_status', '=', 'cancelled')->count();
        $subscribers_cnt = Subscribe::all()->count();


        $dates = DB::table('orders')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('IFNULL(COUNT(*), 0) as count'))
            ->where('created_at', '>=', Carbon::today()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

            for ($i = 0; $i <= 6; $i++) {
                $date = Carbon::today()->subDays($i)->format('Y-m-d');
                $count = 0;
                foreach ($dates as $record) {
                    if ($record->date == $date) {
                        $count = $record->count;
                        break;
                    }
                }
                $lastSevenDays[$i] = $count;
            }

        

        return view('admin-page.admin_board', [
            'products_cnt'=>$products_cnt, 
            'orders_cnt'=>$orders_cnt,
            'customers_cnt'=>$customers_cnt, 
            'revenue_tot'=>$revenue_tot, 
            'delivered_cnt'=>$delivered_cnt, 
            'processing_cnt'=>$processing_cnt,
            'cancelled_cnt'=>$cancelled_cnt,
            'subscribers_cnt'=>$subscribers_cnt,
            'last_seven_days'=>$lastSevenDays,
            'contacts'=>Contact::orderBy('id', 'desc')->take(5)->get()
        ]); 
    }

    //ndryshime ktheji sic qene
    public function view_categroy()
    {
        $categories = Category::orderBy('category_name', 'asc')->paginate(15);
        $contacts = Contact::orderBy('id', 'desc')->take(5)->get();
        return view("admin-page.category", ["categories" => $categories, "contacts"=>$contacts]);
    }

    // public function getLatestContacts()
    // {
    //     $contacts = Contact::orderBy('id', 'desc')->take(5)->get();
    //     return response()->json($contacts);
    // }

    public function add_category(Request $request)
    {
        $validated = $request->validate([
            "category_name" => "required|min:3|unique:categories,category_name"
        ]);
        Category::create($validated);
        return back()->with("success", "Category added successfully");    
    }

    public function delete_category($id)
    {
        $ans = Category::destroy($id);
        if ($ans == true) {
            return back()->with("success", "Category deleted successfully");
        } else {
            return back()->with("danger", "Failed to delete category");
        }
    }

    // subcategory po punon
    public function view_subcategory($id){
        $category=Category::find($id);
        $subcategories = $category->subcategories;
        $contacts = Contact::orderBy('id', 'desc')->take(5)->get();
        return view('admin-page.subcategory', ['category'=>$category, 'subcategories'=>$subcategories, 'contacts'=>$contacts]);
    }

    public function add_subcategory(Request $request, $id){
        $validated = $request->validate([
            "subcategory_name" => "required|min:3|unique:subcategories,subcategory_name"
        ]);
        $validated['category_id']=$id;
        Subcategory::create($validated);
        return back()->with("success", "Subcategory added successfully");
    }

    public function delete_subcategory($id){
        $ans = Subcategory::destroy($id);
        if ($ans == true) {
            return back()->with("success", "Subcategory deleted successfully");
        } else {
            return back()->with("danger", "Failed to delete subcategory");
        }
    }


    public function view_add_products()
    {
        $categories = Category::orderBy('category_name', 'asc')->get();
        $contacts = Contact::orderBy('id', 'desc')->take(5)->get();
        return view('admin-page.add_products', ["categories" => $categories, "contacts"=> $contacts]);
    }

    public function add_products(ProductRequest $request)
    {
            $validated = $request->validated();
            if ($request->hasFile("prod_image")) {
                $file = $request->file("prod_image");
                $name = $file->hashName();
                $extension = $file->extension();
                $imgName = $name . "." . $extension;
                $file->move("images/products", $imgName);
                $validated["prod_image"] = $imgName;
            }
            $subcategories = $validated['subcategories'];
            unset($validated['subcategories']);
            $product = Product::create($validated);
            $productId = $product->id;

            $nosubcategory=true;
            foreach($subcategories as $key => $value) {
                for ($i = 1; $i < count($value); $i++) {
                    if (!isset($value[$i])) {
                        break;
                    }
                    if (!empty($value[$i])) {
                        ProductSubcategory::create([
                            'subcategory_id' => (int) $value[$i],
                            'product_id' => (int) $productId
                        ]);
                        $nosubcategory = false;
                    }
                }
            }
            if($nosubcategory){
                $product->delete();
                return back()->with("danger", "Select a subcategory");
            }

            return back()->with("success", "Product added successfully");
    }

    public function view_show_products(Request $request)
    {   
        $contacts = Contact::orderBy('id', 'desc')->take(5)->get();
        // $products = Product::join('categories', 'products.category_id', '=', 'categories.id')->filter(request(['search-admin']))->select('products.*')->paginate(25);
        // $products = Product::join('product_subcategories', 'products.id', '=', 'product_subcategories.subcategory_id')->filter(request(['search-admin']))->select('products.*')->paginate(25);
        $products = Product::paginate(25);
        // $products = Product::join('product_subcategory', 'products.id', '=', 'product_subcategory.product_id')->join('subcategories','product_subcategory.subcategory_id', '=', 'subcategories.id')->filter(request(['search-admin']))->select('products.*')->paginate(25);
        return view('admin-page.show_products', ["products" => $products, "contacts"=>$contacts]);
    }

    public function delete_products($id)
    {
        $orders = Order::join('carts', 'orders.cart_id', '=', 'carts.id')
        ->join('users','carts.user_id','=','users.id')
        ->join('products', 'carts.prod_id', '=', 'products.id')
        ->where('carts.prod_id','=',$id)
        ->select('orders.*', 'users.*', 'products.*','products.id as prod_id', 'carts.*')->get();

        //fshi produktin
        $product = Product::find($id);
        if($product==null){
            return redirect()->back()->with('danger', 'Product not found. Refresh page.');
        }
        else{
            $product->delete();
        }

            // email qe order eshte anulluar
        if(!$orders->isEmpty()){
            foreach($orders as $order){
                if($order->delivery_status=='processing'){
                    $cancellationMsg = [
                        "greeting"=>"Hi " . $order->name,
                        "firstline"=>"I feel sorry", 
                        "body"=>"Your order number:" . $order->id ." of ". $order->quantity . " " . $order->prod_title ."(s) with total price of: " . $order->price . "$ is cancelled", 
                        "button"=>"Go to Famms", 
                        "url"=>route("home"), 
                        "lastline"=>"Feel free to contact us"
                    ];
                    Notification::send($order, new SendEmailNotification($cancellationMsg));
                }
        }}

        //printo te gjithe orders qe jane anulluar
        return $this->print_cancelled_orders($orders);
    }

    public function print_cancelled_orders($orders)
    {
        // $pdf = PDF::loadView('admin-page.orders_pdf', ['orders' => $orders]);
        // return $pdf->download('orders_cancelled.pdf');

        $pdf = PDF::loadView('admin-page.orders_pdf', ['orders' => $orders]);
        $pdf->setOptions(['isPhpEnabled' => true]);
        $pdf->setPaper('legal', 'landscape');
        $pdfContent = $pdf->output();
        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="orders_cancelled.pdf"');
        
    }


    public function view_edit_products($id)
    {
        $product = Product::find($id);
        $categories = Category::orderBy('category_name', 'asc')->get();
        $contacts = Contact::orderBy('id', 'desc')->take(5)->get();
        return view('admin-page.edit_products', ["categories" => $categories, "product" => $product, "contacts"=>$contacts]);
    }

    public function edit_products(ProductRequest $request, int $id)
    {
        $product = Product::find($id);

        $validated = $request->validated();
        if ($request->hasFile("prod_image")) {
            $file = $request->file("prod_image");
            $name = $file->hashName();
            $extension = $file->extension();
            $imgName = $name . "." . $extension;
            $file->move("images/products", $imgName);
            $validated["prod_image"] = $imgName;
        }
        $subcategories = $validated['subcategories'];
        $product->update($validated);
        $productId = $product->id;

        $relations = ProductSubcategory::where('product_id', '=', $productId)->get();
        foreach($relations as $relation){
            $relation->delete();
        }
        
        $nosubcategory=true;
        foreach($subcategories as $key => $value) {
            for ($i = 1; $i < count($value); $i++) {
                if (!isset($value[$i])) {
                    break;
                }
                if (!empty($value[$i])) {
                    ProductSubcategory::create([
                        'subcategory_id' => (int) $value[$i],
                        'product_id' => (int) $productId
                    ]);
                    $nosubcategory = false;
                }
            }
        }
        if($nosubcategory){
            $product->delete();
            return back()->with("danger", "Select a subcategory");
        }

        //ndrysho me join
        // $orders = Order::join('carts', 'orders.cart_id', '=', 'carts.id')->where('carts.prod_id','=',$id)
        // ->select('orders.*')->get();
        // $orders = Order::where('prod_id','=',$id)->get();
        //seshte nevoja nese e ke bere update ne cascade, kontrolloje serish
        // foreach($orders as $order){
        //     if($order->cart->quantity>$validated['prod_quantity'] && $order->delivery_status=='processing'){
        //         $order->delivery_status='cancelled';
        //         $order->update();
        //     }
        //     //mund te shtosh ne rast se e rrit quantity dhe order eshte cancelled , ta besh processing prap
        // }
        
        return redirect('/view_show_products')->with("success", "Product updated successfully");
    }

    public function show_orders(Request $request)
    {
        $contacts = Contact::orderBy('id', 'desc')->take(5)->get();
        //pas filtrit
        $orders =Order::join('carts', 'orders.cart_id', '=', 'carts.id')->join('users', 'carts.user_id','=','users.id')
        ->join('products','carts.prod_id','=','products.id')->filter(request(['search']))->select('orders.*')->paginate(20);
        return view('admin-page.show_orders', ["orders" => $orders, "contacts"=>$contacts]);
    }

    public function delivered($id)
    {
        $order = Order::find($id);
        $order->payment_status = "paid";
        $order->delivery_status = "delivered";
        $order->update();
        return redirect()->back();
    }

    public function cancel_order($id){
        $order = Order::where('id', '=', $id)->first();
        $order->delivery_status='cancelled';
        $product = Product::find($order->prod_id);
        if($product){
            $product->prod_quantity+=$order->quantity;
            $product->update();
        }
        $order->update();
        return redirect()->back()->with('success', 'Order cancelled successfully');
    }


    public function print_pdf($id)
    {
        $order = Order::find($id);
        $pdf = PDF::loadView('admin-page.pdf', ['order' => $order]);
        return $pdf->download('order_details_'.$order->id .'.pdf');
    }

    public function send_email($id)
    {
        $order = Order::find($id);
        $contacts = Contact::orderBy('id', 'desc')->take(5)->get();
        return view('admin-page.email_info', ['order' => $order, "contacts"=>$contacts]);
    }

    public function send_email_notification(EmailRequest $r, int $id)
    {
        $validated = $r->validated();
        $order = Order::find($id);   
        Notification::send($order->cart->user, new SendEmailNotification($validated));
        return redirect()->back()->with('success', 'Email sent successfully!');
    }

    public function send_message(EmailRequest $r)
    {
        $validated = $r->validated();
        $contact = Contact::find($r->contact_id);   
        Notification::send($contact, new SendEmailNotification($validated));
   
        // per ta fshire pasi pergjigjesh
        // Contact::destroy($r->contact_id);
        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    public function view_email_all(){
        $contacts = Contact::orderBy('id', 'desc')->take(5)->get();
        $subscribers = Subscribe::orderBy('email', 'asc')->paginate(20);
        return view('admin-page.view_email_all', ['contacts'=>$contacts, 'subscribers'=>$subscribers]);
    } 

    public function delete_subscriber($id){
        $status = Subscribe::destroy($id);
        if($status){
            return redirect()->back()->with('success', 'Subscriber deleted successfully');
        }
        else{
            return redirect()->back()->with('danger', 'Failed to delete subscriber');
        }
    }

    public function email_all(EmailRequest $r){
        $emails = Subscribe::all();
        foreach($emails as $email){
            $validated = $r->validated();
            Notification::send($email, new SendEmailNotification($validated));
        }
        return redirect()->back()->with('success', 'Emails sent successfully!');
    }

    public function all_messages(){
        $contacts = Contact::orderBy('id', 'desc')->paginate(10); 
        return view("admin-page.all_messages", ["contacts"=>$contacts]);
    }

    public function delete_message($id){
        $status = Contact::destroy($id);
        if($status){
            return redirect()->back()->with('success', 'Message deleted successfully');
        }
        else{
            return redirect()->back()->with('danger', 'Failed to delete message');
        }
    }

    public function view_upload_photo(){
        return view('admin-page.view_upload_photo');
    }

    public function upload_photo(Request $r){
        $user = auth()->user();
        if ($r->hasFile("image")) {
            $file = $r->file("image");
            $name = $file->hashName();
            $extension = $file->extension();
            $imgName = $name . "." . $extension;
            $file->move("images/admin", $imgName);
            $user->image = $imgName;
            $user->update();
        } else{
            $user->image = null;
            $user->update();
        }
        echo "<script>window.close();</script>";
    }

    public function view_change_password(){
        $contacts = Contact::orderBy('id', 'desc')->get(); 
        return view('admin-page.view_change_password', ['contacts'=>$contacts]);
    }

    public function change_password(UserRequest $r){
        $validated = $r->validated();
        $user = auth()->user();

        if(Hash::check($validated['old_pass'], $user->password)){
            $user->password = bcrypt($validated['new_pass']);
            $status = $user->update();
            if($status){
                return redirect()->back()->with('success', 'Password changed successfully!');
            }
            else{
                return redirect()->back()->with('danger', 'Password failed to change!');
            }
        }
        return redirect()->back()->withErrors(['old_pass'=>'Old password is incorrect!']);
    }

    public function view_account_settings(){
        $contacts = Contact::orderBy('id', 'desc')->get(); 
        return view('admin-page.view_account_settings', ['contacts'=>$contacts]);
    }

    public function account_settings(UserRequest $r){
        $validated = $r->validated();
        $user = auth()->user();
        $user->name = $validated['name'];
        $user->phone = $validated['phone'];
        $status = $user->update();
        if($status){
            return redirect()->back()->with('success', 'Account Settings Updated Successfully!');
        }
        else{
            return redirect()->back()->with('danger', 'Account Settings Failed to Update!');
        }
    }

}
