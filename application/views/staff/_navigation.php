    <nav>

        <div class="hero-banner">
            <div class="banner-wrapper">
                <img src="<?php echo base_url('assets/'); ?>styles/resources/logo.png" alt="logo.png">
                <h3>clsu</h3>
            </div>

            <i class="fas fa-times" id="toggleMenuClose"></i>
        </div>

        <div class="search-mobile-wrapper">
            <form id="formSearchRequest2">
                <input type="text" name="getSearchName" id="searchName2" placeholder="Search name" autocomplete="off">
                <button class="btn btn-primary d-none">Search</button>
            </form>
        </div>

        <ul>
            <input type="text" class="form-control d-none" id="navID" value="2">
            <li>
                <a href="" id="navAllRequest">
                    <i class="fas fa-inbox"></i>
                    <p>All Requests</p>
                </a>
            </li>

            <li>
                <a href="" id="navPendingRequest">
                    <i class="fas fa-comment-dots"></i>
                    <p>Pending <div class="content-counts" id="pendingCount">0</div></p>
                </a>
            </li>

            <li>
                <a href="" id="navDeliveryRequest">
                    <i class="fas fa-truck"></i>
                    <p>On Delivery <div class="content-counts" id="deliveryCount">0</div></p>
                </a>
            </li>

            <li>
                <a href="" id="navSentRequest">
                    <i class="fas fa-paper-plane"></i>
                    <p>Sent</p>
                </a>
            </li>

            <li>
                <a href="" id="navDeclinedRequest">
                    <i class="fas fa-exclamation-circle"></i>
                    <p>Declined</p>
                </a>
            </li>

            <hr>
            
            <li>
                <a href="" id="navDrafts">
                    <i class="fas fa-file-alt"></i>
                    <p>Drafts</p>
                </a>
            </li>

            <li>
                <a href="" id="navOutbox">
                    <i class="fas fa-comment-alt"></i>
                    <p>Outbox <div class="content-counts" id="outboxCount">0</div></p>
                </a>
            </li>
            
            <li>
                <a href="" id="navReminders">
                    <i class="fas fa-bell"></i>
                    <p>Reminders <div class="content-counts" id="reminderCount">0</div></p>
                </a>
            </li>

            <li class="logout-button">
                <a class="logout-a" id="navLogout">
                    <i class="fas fa-sign-out-alt"></i>
                    <p>logout</p>
                </a>
            </li>
        </ul>
    </nav>