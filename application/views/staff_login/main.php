    <div class="login-wrapper">

        <img src="<?php echo base_url('assets/') ?>styles/resources/OADBanner.png" alt="OADBanner.png">

        <form id="formLogin" action="staff_login" method="POST">

            <p class="text-danger fw-bold raleway fs-16 text-center mt-3 mb-0 d-none" id="printValidation"></p>

            <div class="form-group mt-4 mb-3">
                <label for="getUsername" class="form-label">Username</label>
                <input type="text" id="getUsername" class="form-control" name="getUsername" value="<?php echo set_value('getUsername'); ?>" autocomplete="on">
            </div>

            <div class="form-group mb-3">
                <label for="getPassword" class="form-label">Password</label>
                <input type="password" id="getPassword" class="form-control" name="getPassword" autocomplete="on">
            </div>

            <div class="login-buttons-wrapper mt-5">
                <button class="btn btn-success poppins w-100 p-3" id="btnLoginEmployees" name="btnLoginEmployees" type="submit">Employees</button>
            </div>

            <p class="poppins text-center text-muted">Copyright © 2021. All rights reserve.</p>

        </form>
    </div>