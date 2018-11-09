@extends('admin/layout/layout')
@section('content-wrapper')
<div class="col-lg-6 grid-margin stretch-card" style="margin:100px auto;">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">网站信息</h4>
                  <p class="card-description">
                    <code>Administrators</code>
                  </p>
                  <table class="table">
                  	@if(session()->has('admin'))
                    <thead>
                      <tr>
                        <th style='width:150px;'>当前管理员名称</th>
                        <th>{{ session('admin')->uname }}</th>
                      </tr>
                    </thead>
                    @endif
   					<tbody>
			            <tr>
			                <th>服务器IP地址</th>
			                <td>{{ $_SERVER['SERVER_ADDR'] }}</td>
			            </tr>
			            <tr>
			                <th>主机名</th>
			                <td>{{ $_SERVER['SERVER_NAME'] }}</td>
			            </tr>
			            <tr>
			                <th>服务器标识</th>
			                <td>{{ $_SERVER['SERVER_SOFTWARE'] }}</td>
			            </tr>
			            <tr>
			                <th>通信协议</th>
			                <td>{{ $_SERVER['SERVER_PROTOCOL'] }}</td>
			            </tr>
			            <tr>
			                <th>客户端IP地址</th>
			                <td>{{ $_SERVER['REMOTE_ADDR'] }}</td>
			            </tr>
			        </tbody>
                  </table>
                </div>
              </div>
            </div>

@endsection