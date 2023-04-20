<?php

namespace App\Http\Controllers;

use Mail;
use Stripe;
use Session;
use HTMLPurifier;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Reply;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use HTMLPurifier_Config;
use App\Models\Subscribe;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\IssueRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{

    public function getTemplateData(){
        $categories = Category::orderBy('category_name', 'asc')->get();
        $num_carts=0;
        $num_orders=0;
        if(auth()->user()){
            $num_carts = count(Cart::where('user_id', '=', auth()->id())->where('ordered', '=', '0')->get());
            $num_orders = count(Order::join('carts', 'orders.cart_id', '=', 'carts.id')->where('carts.user_id', '=', auth()->id())->where('orders.delivery_status', '<>', 'cancelled')->get());
        }
        return array('categories'=>$categories, 'num_carts'=>$num_carts, 'num_orders'=>$num_orders);
    }

    public function view_home_page(){
      
        $header_data = $this->getTemplateData();
        //pas filtrit
        $products = Product::filter(request(['search']))->select('products.*')->paginate(9); 
        $header_data['products'] = $products;       
        return view('home-page.home_page', $header_data);

    }

    public function product_details($id){
        $header_data = $this->getTemplateData();
        // $comments = Comment::orderBy('id', 'desc')->get();
        // $replies = Reply::orderBy('id', 'desc')->get();
        $product = Product::find($id);
        $header_data['product']=$product;
        return view('home-page.product_details', $header_data);
    }

    public function show_cart(){
        $header_data = $this->getTemplateData();
        $carts = Cart::where('user_id', '=', auth()->id())->where('ordered','=','0')->orderBy('id', 'desc')->paginate(15);
        $header_data['carts']= $carts;
        return view('home-page.show_cart', $header_data);       
    } 

    public function add_cart($id, Request $request){
            $user = auth()->user();
            $product = Product::find($id);

            $product_exists= Cart::where('prod_id', '=', $id)
            ->where('user_id','=',$user->id)->where('ordered','=','0')->first();

       
            if($product_exists!=null){
                $cart = $product_exists;
                $cart->quantity+= $request->quantity;

                if($product->prod_discount!=null){
                    $cart->price+= $product->prod_discount*$request->quantity;
                }
                else{
                    $cart->price += $product->prod_price*$request->quantity;
                }
                $cart->update();
            }
            else{
                $cart = [
                    "price"=>$product->prod_price*$request->quantity,
                    "quantity"=>$request->quantity,
                    "prod_id"=>$product->id, 
                    "user_id"=>auth()->id() //$user->id
                ];
                if($product->prod_discount!=null){
                    $cart["price"]= $product->prod_discount*$request->quantity;
                }
                Cart::create($cart);
            }
            return redirect()->back()->with('success', 'Product added successfully');
    }

    public function delete_cart($id){
        $ans = Cart::destroy($id);
        if($ans){
            return redirect()->back()->with('success', 'Product removed successfully');
        }
        else{
            return redirect()->back()->with('danger', 'Something went wrong deleting this product');
        }
    }

    public function view_orders(){
        $header_data = $this->getTemplateData();
        //pas filtrimit
        $orders =Order::join('carts', 'orders.cart_id', '=', 'carts.id')
        ->join('products','carts.prod_id','=','products.id')
        ->where('carts.user_id','=',auth()->id())->filter(request(['search-user']))->select('orders.*')->paginate(15);
        $header_data['orders']=$orders;
        return view('home-page.view_orders', $header_data);
    }

 
    public function view_products(Request $request){
        $header_data = $this->getTemplateData();
        $products = Product::filter(request(['order-by','search']))->paginate(9);
        $header_data['products']= $products;
        return view('home-page.view_products', $header_data);
    }

    public function view_products_category(Request $request, $id){
        $header_data = $this->getTemplateData();
        $category = Category::find($id);
        $products = Product::join('product_subcategory', 'products.id', '=', 'product_subcategory.product_id')
        ->join('subcategories', 'product_subcategory.subcategory_id', '=', 'subcategories.id')
        ->where('category_id','=',$id)->filter(request(['order-by']))->select('products.*')->paginate(9);
        // $products = Product::join('product_subcategory', 'products.id', '=', 'product_subcategory.product_id')
        // ->where('subcategory_id','=',$id)->filter(request(['order-by']))->select('products.*')->paginate(9);
        // dd($products);
        $header_data['products']=$products;
        $header_data['category']=$category;
        // $header_data['subcategory']=$subcategory;
        return view('home-page.view_products', $header_data);
    }

    public function view_products_subcategory(Request $request, $idCat, $idSub){
        $header_data = $this->getTemplateData();
        $subcategory = Subcategory::find($idSub);
        $category = $subcategory->category;
        $products = Product::join('product_subcategory', 'products.id', '=', 'product_subcategory.product_id')
        ->where('product_subcategory.subcategory_id','=',$idSub)->filter(request(['order-by']))->select('products.*')->paginate(9);
        $header_data['products']=$products;
        $header_data['category']=$category;
        $header_data['subcategory']=$subcategory;
        return view('home-page.view_products', $header_data);
    }

    public function add_comment(Request $r){
        $user = auth()->user();
        $validated = $r->validate([
            "comment"=>"required",
            "prod_id"=>"required"
        ]);
        $cleanComment = $this->purify($validated['comment']);
        Comment::create([
            'comment'=>$cleanComment,
            'user_id'=>$user->id,
            'prod_id'=>$validated['prod_id']
        ]);
        return redirect()->back();
       
    }
    private function purify(string $html): string
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', 'p,em,strong');
        $purifier = new HTMLPurifier($config);
        return $purifier->purify($html);
    }

    public function delete_comment($id){
        Comment::destroy($id);
        return back();
    }

    public function add_reply(Request $r){
        $user = auth()->user();
        
            Reply::create([
                'name'=>$user->name,
                'comment_id'=>$r->comment_id,
                'reply'=>$r->reply,
                'user_id'=>$user->id
            ]);
            return redirect()->back();
    }

    public function delete_reply($id){
        Reply::destroy($id);
        return back();
    }

    public function order(Request $r){
        //ben pjesen update
        $userId = auth()->id();
   
        $validated = $r->validate([
            "name"=>"required",
            "address"=>"required", 
            "phone"=>"required|numeric", 
            // "total"=>"required"
        ]);
        $storedTotal = session()->get('total');
        $validated['total'] = $storedTotal;
        // $userTotal = $validated['total'];

        // if ($storedTotal != $userTotal) return back()->with('danger','The total amount submitted does not match the actual total.');
        if($storedTotal==0) return back()->with('danger', 'No products to order');
        // if($r->total==0) return back()->with('danger', 'No products to order');

        $user = User::find($userId);
        $user->name = $validated['name'];
        $user->phone = $validated['phone'];
        $user->update();

        //ndan cfr ke shtypur
        if($r->cash_order) return $this->cash_order($validated);
        if($r->cart_order) return view('home-page.stripe', ['total'=>$storedTotal, 'address'=>$validated['address']]);
    }

    public function stripe_post(Request $r)
    {
        $userId = auth()->id();
        $carts = Cart::where('user_id', '=', $userId)->where('ordered', '=','0')->get();
       
        //if user doesnt have any cart
        if($carts->isEmpty()){
            return redirect('/view_orders')->with('danger', 'No products to order');
        }

        //if product quantity has changed so cart quantity cannot be ordered anymore
        $left_carts=false;
        foreach($carts as $cart){
           if($cart->quantity> $cart->product->prod_quantity){
                Cart::destroy($cart->id);
                $left_carts=true;
            }
        }
        if($left_carts==true){
            return redirect('/view_orders')->with('danger', 'Orders denied!Quantity of some products that you ordered is not available anymore.Check again.');
        } 

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        //pay using cart
        $storedTotal = session()->get('total');
        Stripe\Charge::create ([
                "amount" => $storedTotal * 100,
                "currency" => "usd",
                "source" => $r->stripeToken,
                "description" => "Thanks for the payment!" 
        ]);
        
        //continue ordering
        foreach($carts as $cart){
            $order = [
                'address'=> e($r->address), 
                'cart_id'=> $cart->id,
                'payment_status'=> 'paid',
                'delivery_status'=> 'processing'
            ];
            Order::create($order);
            $cart->product->prod_quantity -= $cart->quantity;
            $cart->product->update();
            $cart->ordered='1';
            $cart->save();
        }
        return redirect('/view_orders')->with('success', 'We have received your order. We will connect with you soon...');
    }

    
    public function cash_order($validated){
        $userId = auth()->id();
        $carts = Cart::where('user_id', '=', $userId)->where('ordered','=','0')->get();
        
        //if user doesnt have any cart
        if($carts->isEmpty()){
            return back()->with('danger', 'No products to order');
        }

        //if product quantity has changed so cart quantity cannot be ordered anymore
        $left_carts=false;
        foreach($carts as $cart){
           if($cart->quantity> $cart->product->prod_quantity){
                Cart::destroy($cart->id);
                $left_carts=true;
            }
        }
        if($left_carts==true){
            return back()->with('danger', 'Orders denied!Quantity of some products that you ordered is not available anymore.Check again.');
        } 

        

        //continue ordering
        foreach($carts as $cart){
            $order = [
                'cart_id'=> $cart->id,
                'address'=>$validated['address'],
                'payment_status'=> 'cash on delivery',
                'delivery_status'=> 'processing'
            ];
            Order::create($order);
            $cart->product->prod_quantity -= $cart->quantity;
            $cart->product->update();
            $cart->ordered = '1';
            $cart->save();
        }
        return back()->with('success', 'We have received your order. We will connect with you soon...');
    }

    public function add_email(Request $r){
        $validated = $r->validate([
            'email' => 'required|unique:subscribes,email|max:40',
        ]);
        $status = Subscribe::create($validated);
        if($status){
            return redirect()->back()->with('success', 'You have successfully subscribed!');
        }
        else{
            return redirect()->back()->with('danger', 'Failed to subscribe!');
        }
    }

    public function view_contact(){
        $header_data = $this->getTemplateData();
        return view('home-page.view_contact',$header_data);
    }

    public function send_issue(IssueRequest $r){
        $validated = $r->validated();
        $status = Contact::create($validated);
        if($status){
            return redirect()->back()->with('success', 'Issue sent successfully');
        }
        else{
            return redirect()->back()->with('danger', 'Failed to send issue');
        }
    }

    
    public function view_about(){
        $header_data = $this->getTemplateData();
        return view("home-page.view_about", $header_data);
    }

    public function view_account_profile(){
        $header_data = $this->getTemplateData();
        return view('home-page.account_profile', $header_data);
    }

    public function account_profile(UserRequest $r){
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

    public function view_change_password(){
        $header_data = $this->getTemplateData();
        return view('home-page.view_change_password', $header_data);
    }

}
