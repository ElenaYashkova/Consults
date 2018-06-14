<div class="ContainerAuthoriz Auth">
    <h2>User Login</h2>
    <form action="login" class="Authoriz" method="post" enctype="multipart/form-data">
        <div class="formLine">
            <input type="text" name="login" placeholder="Login">
            <div class="icon log"></div>
        </div>
        <div class="formLine">
            <input type="password" name="pass" placeholder="Password">
            <div class="icon reg"></div>
        </div>
        <a href="#" id="resend">Forgot password?</a>
        <div class="lineBtn">
            <div class="btnLog">
                <input type="submit" value="LOGIN" id="log">
            </div>
            <div class="btnReg" id="showReg">
                <a href="#">REGISTER</a>
            </div>
        </div>
    </form>
</div>

<div class="ContainerAuthoriz Register">
    <h2>User Registration</h2>
    <form action="reg" class="Authoriz" method="post" enctype="multipart/form-data">
        <div class="formLine">
            <input type="text" name="login" placeholder="Login">
            <div class="icon log"></div>
        </div>
        <div class="formLine">
            <input type="text" name="name" placeholder="Name">
            <div class="icon log"></div>
        </div>
        <div class="formLine">
            <input type="text" name="surname" placeholder="Surname">
            <div class="icon log"></div>
        </div>
        <div class="formLine">
            <input type="password" name="pass" placeholder="Password">
            <div class="icon reg"></div>
        </div>
        <div class="formLine">
            <input type="email" name="mail" placeholder="Email">
            <div class="icon reg"></div>
        </div>
        <div class="lineBtn">
            <div class="btnLog" id="showLogin">
                <a href="#">LOGIN</a>
            </div>
            <div class="btnReg">
                <input type="submit" value="REGISTER" id="reg">
            </div>
        </div>
    </form>
</div>

<div class="ContainerAuthoriz Resend">
    <h2>Resend Password</h2>
    <form action="mail" class="Authoriz" method="post" enctype="multipart/form-data">
        <div class="formLine">
            <input type="text" name="login" placeholder="Login">
            <div class="icon log"></div>
        </div>
        <div class="formLine">
            <input type="tel" name="mail" placeholder="Email">
            <div class="icon reg"></div>
        </div>
        <div class="lineBtn">
            <div class="btnLog">
                <input type="submit" value="SEND" id="log">
            </div>
            <div class="btnReg" id="back">
                <a href="#">BACK</a>
            </div>
        </div>
    </form>
</div>

