<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Purple Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/admin/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/admin/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/admin/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/admin/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="/admin/images/logo.png" style="width:280px;height:60px;">
              </div>
              <h4 style="color:#ccc;">新用户?点了注册我们的故事就开始了!</h4>
               @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
              <form class="pt-3" action='/admin/login/doregister' method='post'>
                 {{ csrf_field() }} 
                <div class="form-group">
                  <input type="text" name="uname" class="form-control form-control-lg" id="uname" placeholder="请输入用户名">
                </div>
                <div class="form-group">
                  <input type="password" name="upass" class="form-control form-control-lg" id="upass" placeholder="请输入密码">
                </div>
                 <div class="form-group">
                  <input type="password" name="upassok" class="form-control form-control-lg" id="upassok" placeholder="请再次输入确认密码">
                </div>
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      我同意所有条款和条件
                    </label>
                  </div>
                </div>
                <div class="mt-3">
                 <input type="submit" value='注册' style='width:260px;height:50px;background:#c588f0;border:none;font-size:15px;color:#fff;'>
                </div>
                <div class="text-center mt-4 font-weight-light">
                 已经有账号？ <a href="/admin/login/login" class="text-primary">登录</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="/admin/vendors/js/vendor.bundle.base.js"></script>
  <script src="/admin/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="/admin/js/off-canvas.js"></script>
  <script src="/admin/js/misc.js"></script>
  <!-- endinject -->
</body>

</html>
