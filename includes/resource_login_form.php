<div class="card" id="login_card">
    <div class="card-header">
        <h3 class="sub-header">Login</h3>
    </div>
    <div class="card-block">
        <!-- <h4 class="card-title">Special title treatment</h4>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
        <form action="login.php" method="post" class="regular-form">
            <div class="form-group">

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" onblur="checkFieldEmpty(this.value, this.id, 'login')" />
                <span class="errDisplay"></span>
                
            </div>
            <div class="form-group">

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" onblur="checkFieldEmpty(this.value, this.id, 'login')" />
                <span class="errDisplay"></span>
                
            </div>

            <input type="hidden" name="handle_redirect" id="handle_redirect" value="1" />

            <div class="form-group text-left">
                <button type="submit" class="btn btn-primary btn-md ml-0">Login <i class="fa fa-long-arrow-right"></i></button>
            </div>
        </form>
    
        <hr>

        <label><a href="register.php">Don't have an account?</a></label>

    </div>
</div>