<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use DB;

class SidebarMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $route;
    public $value;
    public $LRoute;
    public $class;

    public function __construct($data,$class,$value)
    {
        $this->route=$data;
        $this->class=$class;
        $this->value=$value;
        $routename=$data;
        $routeN=rtrim($routename, 's');
    
        $id=Auth::user()->id;
        // dd($id);
        $role_id=DB::Table('roles')->select('id')
        ->join('model_has_roles','model_has_roles.role_id','=','roles.id')
        ->where('model_has_roles.model_id',$id)->get()->toArray();

        $roleid=$role_id[0];
        // dd($roleid);

        $permissions=DB::Table('permissions')->select('http_uri')
                    ->join('role_has_permissions','role_has_permissions.permission_id','=','permissions.id')
                    ->where('role_has_permissions.role_id',$roleid->id)
                    ->where('http_uri', 'like', '%'.$routename.'%')->get()->toArray();
// dd($http_uri);

        $i=0;
        $this->LRoute = array();
        $LRoute['list']="No";
        $LRoute['create']="No";
        $LRoute['delete']="No";
        $LRoute['edit']="No";

        foreach ($permissions as $key=>$value) {
            if ((str_contains($value->http_uri, $routename)==1)&&(str_contains($value->http_uri, 'GET::')==1) && (!str_contains($value->http_uri, 'create')) && (!str_contains($value->http_uri, 'edit')) && (!str_contains($value->http_uri, '{'.$routeN.'}')) && (!str_contains($value->http_uri, 'DELETE'))) {
                $this->LRoute['list'] = $value->http_uri;
            } 
           
            if ((str_contains($value->http_uri, 'create')==1)&&(str_contains($value->http_uri, $routename)==1)) {  
                $this->LRoute['create'] = $value->http_uri;
            }
        
            if (str_contains($value->http_uri, 'DELETE')==1) {  
                $this->LRoute['delete'] = $value->http_uri;
            } 
            
            if ((str_contains($value->http_uri, 'edit')==1)&&(str_contains($value->http_uri, '{'.$routeN.'}')==1)) {
                $this->LRoute['edit'] = $value->http_uri;
            }
        
            $i++;
        }
    
    }

        

        
    
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar-menu');
    }
}
