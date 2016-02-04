<div class="row marketing">
    <div class="col-lg-12">
        <h2>Authorization - Sign up</h2>

        <form class="form-signin" method="POST">

            {{ flashSession.output() }}

            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
            <br/>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
            <br/>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
                </div>
            </div>
        </form>

    </div>
</div>