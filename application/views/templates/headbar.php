<div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-danger " href="#"><i class="fa fa-bars"></i> </a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message text-uppercase"><?= $user['TXT_NAMA'] ?></span>
                </li>
                <li class="dropdown">
                    <ul class="dropdown-menu dropdown-messages">
                        
                        <li class="dropdown-divider"></li>
                        
                    </ul>
                </li>
                <li>
                <button class="btn logout text-danger">
                        <i class="fa fa-sign-out"></i> LOG OUT
                    </button>
                </li>
            </ul>

        </nav>
    </div>