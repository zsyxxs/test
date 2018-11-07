<?php
namespace app\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use app\Http\Logic\UserLogic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class IndexController extends Controller
{
    public function login(Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->input();
            $rules = [
                'name' => 'required',
                'password' => 'required|between:6,20',
//                'captcha' => 'required|captcha'
            ];
            $messages = [
                'name.required' => '用户名不能为空',
                'password.required' => '密码不能为空',
                'password.between' => '密码长度必须是6到20',
                'captcha.required' => '验证码不能为空',
//                'captcha.captcha' => '验证码不正确',
            ];
            $validate = Validator::make($data,$rules,$messages);
            if($validate->passes()){
                //判断用户信息是否正确
                $logic = new UserLogic();
                $result = $logic->checkInfo($data);
                return $result;

            }else{
//                return back()->with('error',$validate->errors());
                return back()->withErrors($validate);
            }

        }else{
            return view('admin/login');
//        return '登录成功';
        }

    }

    public function register(Request $request)
    {

    }
}