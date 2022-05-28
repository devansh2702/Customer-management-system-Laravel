<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Models\admin;
use App\Models\client;
use Session;
class CRMcontroller extends Controller
{
    //
    public function login(Request $req)
    {
            $data=admin::where('username','=',$req->username)->get()->toArray();
            //if($data[0]['username']== $req->username)
            if ($data==NULL) {
                $errormsg="NO SUCH ADMIN FOUND";
                return view('login',["errormsg"=>$errormsg]);
            }
            else if($data[0]['password']!=$req->password)
            {
                $errormsg="INVALID PASSWORD";
                return view('login',["errormsg"=>$errormsg]);

            }
            else{
                
                $errormsg="";
                $clients=client::all();
                return view('home',["client"=>$clients,"data"=>$data,"errormsg"=>$errormsg]);
            }
    }
    public function forgotpassword(Request $req)
    
    {
        
        $data=admin::where('username','=',$req->username)->get()->toArray();
        
        $user['to']=['19bce247@nirmauni.ac.in'];
        $user['subject']="Password for CRM";
        Mail::send('forgotmail',["data"=>$data],function($messages) use ($user)
        {
            $messages->to($user['to']);
            $messages->subject($user['subject']);
        });
        
    }
    function payment($id)
    {
        $client=client::find($id);
        return view('payment',['data'=>$client]);
    }
    public function sendmail(Request $req)
    {
        // $ob=client::find($id);

        $data=client::where('id','=',$req->id)->get()->toArray();
        // $data=["data"=>$ob];
        
        $user['to']=['19bce247@nirmauni.ac.in'];
        $user['subject']='Payment reminder';
        Mail::send('remindermail',["data"=>$data,"amt"=>$req->amount],function($messages) use ($user)
        {
            $messages->to($user['to']);
            $messages->subject($user['subject']);
        });
        $clients=client::all();
        return view('home',['client'=>$clients]);
    }
    
    function add(Request $req)
    {
        //return $req->input();
        $total_business=0;
        $client=new client;
        $client->id=$req->id;
        $client->name=$req->name;
        $client->email=$req->email;
        $client->contact=$req->contact;
        $client->joining_date=$req->joining_date;
        $client->last_transaction=$req->last_transaction;
        $client->total_business=$total_business+$req->last_transaction;
        $client->save();

        //$req->session()->flash('status','Restaurant updated successfully');
        //return view('home',[]);
        $errormsg="";
        $clients=client::all();
        return view('home',["client"=>$clients]);
            
}
    function update($id)
    {
        $client=client::find($id);
        return view('update',['data'=>$client]);
    }
    function change(Request $req)
    {
        
        $client=client::find($req->id);

        $client->name=$req->name;
        $client->email=$req->email;
        $client->contact=$req->contact;
        $client->joining_date=$req->joining_date;
        $client->last_transaction=$req->last_transaction;
        $client->total_business=$client->total_business+$req->last_transaction;
        $client->save();

        $clients=client::all();
        //$req->session()->flash('status','Restaurant updated successfully');
        return view('home',["client"=>$clients]);

    }
    function delete($id)
    {
        client::find($id)->delete();
        
        $clients=client::all();
        //Session::flash('status','Restaurant deleted succesfully');
        return view('home',["client"=>$clients]);
    }
}
