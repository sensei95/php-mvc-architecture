<div class="mt-6">
    <div class="row">
        <div class="col-md-6">
            <h1>Login</h1>
            <form method="post" action="/login">
                <div class="mb-3">
                    <label for="username" class="form-label">Email address</label>
                    <input type="text" name="username" class="form-control" id="username" aria-describedby="usernameHelp">
                    <div id="usernameHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Check me out</label>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Log In</button>
            </form>
        </div>
    </div>
</div>