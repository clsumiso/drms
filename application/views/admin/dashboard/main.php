<div class="custom-container mt-4">
        <h2 class="page-title mobile">dashboard</h2>

        <div class="widgets-wrapper">

            <div class="widget-wrapper-flex">
                <div class="widget blue">
                    <div class="count-title-wrapper">
                        <p class="widget-count" id="monthlyCount">0</p>
                        <p class="widget-title">monthly request</p>
                        <p class="widget-last">Last month: <b id="monthlyCountLast">0</b></p>
                    </div>
                    
                    <i class="fa-solid fa-message"></i>
                </div>
    
                <div class="widget green">
                    <div class="count-title-wrapper">
                        <p class="widget-count" id="completedCount">0</p>
                        <p class="widget-title">completed request</p>
                        <p class="widget-last">Last month: <b id="completedCountLast">0</b></p>
                    </div>
                    
                    <i class="fa-solid fa-calendar"></i>
                </div>
                
            </div>
            
            <div class="widget-wrapper-flex">
                <div class="widget dark-blue">
                    <div class="count-title-wrapper">
                        <p class="widget-count" id="pendingCount">0</p>
                        <p class="widget-title">pending request</p>
                        <p class="widget-last">Last month: <b id="pendingCountLast">0</b></p>
                    </div>
                    
                    <i class="fa-solid fa-envelope"></i>
                </div>
                
    
                <div class="widget red">
                    <div class="count-title-wrapper">
                        <p class="widget-count" id="declinedCount">0</p>
                        <p class="widget-title">declined request</p>
                        <p class="widget-last">Last month: <b id="declinedCountLast">0</b></p>
                    </div>
                    
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
            </div>
            

        </div>

        <div class="account-managet-dashboard">

            <h3 class="wrapper-title m-0 mb-1">Employee Monthly Status</h3>

            <div class="table-wrapper">
                <table class="table table-borderless table-striped" id="tblEmployeeStatus">
                    <thead>
                        <th class="d-none">Info</th>
                        <th>Staff Name</th>
                        <th>Type</th>
                        <th>Monthly</th>
                        <th>Completed</th>
                        <th>Pending</th>
                        <th>Declined</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                       
                    </tbody>

                </table>
            </div>

        </div>



        <div class="chart-pie-graphs-wrapper">

            <div class="chart-wrapper">
                
                <h3 class="wrapper-title mb-3">March Overall Status</h3>

                <div id="chartOverallStats">
    
                </div>

            </div>


            <div class="chart-wrapper">
                
                <h3 class="wrapper-title mb-3">March Most Requested Document</h3>

                <div id="chartMostRequestDocs">
    
                </div>

            </div>


        </div>



    </div>