    <nav>

        <input type="text" class="form-control d-none" id="navID" value="4">

        <div class="hero-banner">
            <div class="banner-wrapper">
            <img src="<?php echo base_url('assets/'); ?>styles/resources/logo.png" alt="logo.png">
                <h3>clsu</h3>
            </div>

            <i class="fas fa-times" id="toggleMenuClose"></i>
        </div>

        <div class="search-mobile-wrapper">
            <input type="text" placeholder="Search">
        </div>

        <ul>
            <li>
                <a href="<?php echo base_url('admin/'); ?>">
                    <i class="fas fa-home"></i>
                    <p>dashboard</p>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url('admin/accounts'); ?>">
                    <i class="fas fa-users"></i>
                    <p>accounts</p>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url('admin/courses'); ?>">
                    <i class="fas fa-book-open"></i>
                    <p>courses</p>
                </a>
            </li>

            <li>
                <a class="active" href="<?php echo base_url('admin/handlers'); ?>">
                    <i class="fas fa-feather"></i>
                    <p>handlers</p>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url('admin/feedbacks'); ?>">
                    <i class="fas fa-comment-dots"></i>
                    <p>feedbacks</p>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url('admin/reports'); ?>">
                    <i class="fas fa-chart-line"></i>
                    <p>reports</p>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url('admin/maintenance'); ?>">
                    <i class="fas fa-tools"></i>
                    <p>maintenance</p>
                </a>
            </li>

            <li class="logout-button">
                <a class="logout-a" id="toggleLogout">
                    <i class="fas fa-sign-out-alt"></i>
                    <p>logout</p>
                </a>
            </li>
        </ul>

    </nav>

