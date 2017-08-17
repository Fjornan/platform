<?php
namespace Customer\Controller;

class TeamController extends ComController {
    //获取该用户团队列表
    public function teamList(){
        $Team = M('team');
        $User = M('user');
        $Team_User = M('team_user');

        $token = I('get.token');

        $token_res = verifyToken($token);
        if(!$token_res['status']){
            $error = 999;
        }else{
            $user_id = $token_res['id'];
            $link_res = $Team_User->where('user_id='.$user_id)->select();
            for($i=0;$i<count($link_res);$i++){
                $res[$i] = $Team->where('id='.$link_res[$i]['team_id'])->find();
            }
        }
        $result = combineResult(0,$msg,$res);
        $this->ajaxReturn($result);  
    }
    //获取某个团队信息
    public function info(){
        $Team = M('team');
        $Team_User = M('team_user');
        $User = M('user');

        $team_id = I('get.id');
        $res = $Team->where('id='.$team_id)->find();
        $amount = count($Team_User->where('team_id='.$team_id)->select());
        $res['amount'] = $amount;
        $res['leader_name'] = $User->where('id='.$res['leader_id'])->getField('name');

        //获取所有团队成员信息
        $userlist = $Team_User->where('team_id='.$team_id)->select();
        for($i=0;$i<count($userlist);$i++){
            $userinfo = $User->where('id='.$userlist[$i]['user_id'])->find();
            $userlist[$i]['name'] = $userinfo['name'];
            $userlist[$i]['phone'] = $userinfo['phone'];

        }
        $res['user_list'] = $userlist;
        $result = combineResult(0,$msg,$res);
        $this->ajaxReturn($result);  
    }
    //创建新团队
    public function create(){
        $Team = M('team');
        $User = M('user');
        $Team_User = M('team_user');

        $token = I('post.token');
        $add['name'] = I('post.name');

        $token_res = verifyToken($token);
        $add['leader_id'] = $token_res['id']; 
        if(!$token_res['status']){
            $error = 999;
        }else if($add['name'] == ''){
            $error = 101;
            $msg = '团队名称不能为空';
        }else{
            $team_add_res = $Team->add($add);
            if($team_add_res>0){
                $link_add['user_id'] = $token_res['id'];
                $link_add['team_id'] = $team_add_res;
                $link_add_res = $Team_User->add($link_add);
                if($link_add_res>0){
                    $error = 0;
                    $msg = '团队添加成功';
                }else{
                    $error = 105;
                    $msg = '团队关系添加失败';
                }

            }else{
                $error = 105;
                $msg = '团队添加失败';
            }
        }
        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);  
    }

    //更新团队信息
    public function update(){
        $Team = M('team');
        $User = M('user');
        $Team_User = M('team_user');

        $token = I('post.token');
        $update['id'] = I('get.id');
        if(I('post.name')){
            $update['name'] = I('post.name');
        }
        
        $token_res = verifyToken($token);
        $leader_id = $token_res['id']; 
        if(!$token_res['status']){
            $error = 999;
        }else if($Team->where('id='.$update['id'])->getField('leader_id') != $leader_id){
            $error = 201;
            $msg = '非团队创建者，无操作权限';
        }else{
            $update_res = $Team->save($update);
            if($update_res>0){
                $error = 0;
                $msg = '团队信息更新成功';
            }else{
                $error = 105;
                $msg = '团队信息更新失败';
            }
        }
        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);  
    }
    //删除团队
    function delete(){
        $Team = M('team');
        $User = M('user');
        $Team_User = M('team_user');

        $token = I('post.token');
        $id = I('get.id');
        
        $token_res = verifyToken($token);
        $leader_id = $token_res['id']; 
        if(!$token_res['status']){
            $error = 999;
        }else if($Team->where('id='.$id)->getField('leader_id') != $leader_id){
            $error = 201;
            $msg = '非团队创建者，无操作权限';
        }else{
            $delete_res = $Team->delete($id);
            if($delete_res>0){
                $error = 0;
                $msg = '团队删除成功';
            }else{
                $error = 105;
                $msg = '团队删除失败';
            }
        }
        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);  
    }

    //添加团队成员
    public function addMember(){
        $Team = M('team');
        $User = M('user');
        $Team_User = M('team_user');

        $token = I('post.token');
        $add['team_id'] = I('post.team_id');
        $phone = I('post.phone');
        
        $token_res = verifyToken($token);
        $leader_id = $token_res['id']; 
        if(!$token_res['status']){
            $error = 999;
        }else if($add['team_id'] == ''){
            $error = 101;
            $msg = '团队编号不能为空';
        }else if($phone == ''){
            $error = 101;
            $msg = '成员手机号不能为空';
        }else if($Team->where('id='.$add['team_id'])->getField('leader_id') != $leader_id){
            $error = 201;
            $msg = '非团队创建者，无操作权限';
        }else{
            $add['user_id'] = $User->where('phone='.$phone)->getField('id');
            if($add['user_id']){
                $add_res = $Team_User->add($add);
                if($add_res>0){
                    $error =0;
                    $msg = '团队成员添加成功';
                }else{
                    $error = 105;
                    $msg = '团队成员添加失败';
                }
            }else{
                $error = 103;
                $msg = '该用户不存在';
            }
        }
        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);  
    }
    
    //删除团队成员
    function deleteMember(){
        $Team = M('team');
        $User = M('user');
        $Team_User = M('team_user');

        $token = I('post.token');
        $search['team_id'] = I('post.team_id');
        $phone = I('post.phone');
        
        $token_res = verifyToken($token);
        $leader_id = $token_res['id']; 
        if(!$token_res['status']){
            $error = 999;
        }else if($search['team_id'] == ''){
            $error = 101;
            $msg = '团队编号不能为空';
        }else if($phone == ''){
            $error = 101;
            $msg = '成员手机号不能为空';
        }else if($Team->where('id='.$search['team_id'])->getField('leader_id') != $leader_id){
            $error = 201;
            $msg = '非团队创建者，无操作权限';
        }else{
            $search['user_id'] = $User->where('phone='.$phone)->getField('id');
            if($search['user_id']){
                $delete_res = $Team_User->where($search)->delete();
                if($delete_res>0){
                    $error =0;
                    $msg = '团队成员删除成功';
                }else{
                    $error = 105;
                    $msg = '团队成员删除失败';
                }
            }else{
                $error = 103;
                $msg = '该用户不存在';
            }
        }
        $result = combineResult($error,$msg,$res);
        $this->ajaxReturn($result);  
    }

}








