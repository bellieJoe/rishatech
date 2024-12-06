<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow border">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>



    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$_SESSION['user']['full_name']?></span>
                <img class="img-profile rounded-circle" src="https://api.dicebear.com/9.x/bottts/svg?seed=<?=$_SESSION['user']['full_name']?>">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <!-- <a class="dropdown-item" href="route.php?route=view_profile">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="route.php?route=settings">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form class="modal-dialog" role="document" method="POST" action="../app/formController.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" name="ClientLogout">Logout</button>
                </div>
            </div>
        </form>
    </div>

<!-- Notification Container -->
<div id="notificationContainer" style="position: fixed; top: 20px; right: 20px; z-index: 1000; max-width: 300px;"></div>

<style>
    /* Notification Styling */
    .notification {
        background-color: #dfefff; /* Bright yellow for high visibility */
        color: #000; /* Black text for readability */
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Shadow for a pop-out effect */
        font-size: 14px;
        font-weight: bold; /* Bold text for importance */
        animation: slideIn 0.10s ease-out, fadeOut 11s ease-in forwards; /* Add animation */
    }

    /* Animation for sliding in */
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Animation for fading out */
    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }
</style>



    <script>
    // Function to create and display a notification
    function createNotification(itemName) {
        const notificationContainer = document.getElementById("notificationContainer");

        // Create notification element
        const notification = document.createElement("div");
        notification.className = "notification";
       notification.innerHTML = 
    "<strong>Critical Stock Alert</strong><br>" +
    "Item: <strong>" + itemName + "</strong><br>" +
    "Current Stock Level: <strong>2</strong><br>" +
    "Threshold Level: <strong>Red Alert (Low Stock)</strong><br><br>" +
    "Attention is required! The stock level for <strong>" + itemName + "</strong> " +
    "has reached a critical level of <strong>Less than 3</strong>. Please take action promptly to ensure inventory levels are sufficient.";



        // Add notification to the container
        notificationContainer.appendChild(notification);

        // Automatically remove notification after 5 seconds
        setTimeout(() => {
            notification.style.animation = "fadeOut 0.5s forwards";
            setTimeout(() => notification.remove(), 500); // Remove after fade out
        }, 5000);
    }

    // Function to fetch and display low stock warnings
    function showLowStockWarnings() {
        fetch('low_stock_check.php')
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    data.forEach(item => {
                        createNotification(item.appliances_name);
                    });
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Run warning notifications every 10 seconds
    setInterval(showLowStockWarnings, 29000); // 10000 milliseconds = 10 seconds
    </script>


<script>
// Function to format date as "Jan 08, 2001"
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'short', day: '2-digit' };
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', options);
}

// Function to create and display a notification for upcoming payments
function createPaymentNotification(customerName, amountDue, dueDate) {
    const notificationContainer = document.getElementById("notificationContainer");

    const date_format = formatDate(dueDate);

    // Create notification element
    const notification = document.createElement("div");
    notification.className = "notification";
    notification.innerHTML = `
        <strong>Upcoming Payment Due</strong><br>
        Customer: <strong>${customerName}</strong><br>
        Amount Due: <strong>₱${amountDue}</strong><br>
        Due Date: <strong>${date_format}</strong><br><br>
        <small>Notice: A payment of <strong>₱${amountDue}</strong> for <strong>${customerName}</strong> is approaching its due date on <strong>${date_format}</strong>. 
        Please monitor this account for timely payment or follow up if necessary. Early action can help prevent overdue balances.</small>
    `;

    // Add notification to the container
    notificationContainer.appendChild(notification);

    // Automatically remove notification after 10 seconds
    setTimeout(() => {
        notification.style.animation = "fadeOut 0.5s forwards";
        setTimeout(() => notification.remove(), 500); // Remove after fade out
    }, 5000);
}

// Function to fetch and display upcoming payment warnings
function showUpcomingPayments() {
    fetch('upcoming_payments_check.php')
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                data.forEach(item => {
                    createPaymentNotification(item.customer_name, item.amount_due, item.due_date);
                });
            }
        })
        .catch(error => console.error('Error:', error));
}

// Run upcoming payment notifications every 10 seconds
setInterval(showUpcomingPayments, 30000); // 9000 milliseconds = 10 seconds
</script>


