<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <?php echo "Hi " . firstnameFromUserId(); ?>
        <?php //echo "Hi " . userData('firstname'); ?>
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
    </div>
</li>