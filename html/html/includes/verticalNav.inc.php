<div class="column is-3 ">
    <aside class="menu is-hidden-mobile">
        <p class="menu-label">
            General
        </p>
        <ul class="menu-list">
            <li><a class="<?php if($page=='dashboard'){echo 'is-active';}?>" href="dashboard.php">Dashboard</a></li>
            <li><a class="<?php if($page=='support'){echo 'is-active';}?>" href="#">Support</a></li>
            <li><a class="<?php if($page=='help'){echo 'is-active';}?>" href="#">Help</a></li>
        </ul>
        <p class="menu-label">
            Player
        </p>
        <ul class="menu-list">
            <li><a class="<?php if($page=='invitation'){echo 'is-active';}?>" href="invitations.php">Invitations</a></li>
            <li><a class="<?php if($page=='e'){echo 'is-active';}?>" href="#">Notifications</a></li>
            <li><a class="<?php if($page=='e'){echo 'is-active';}?>" href="#">Leave a Group</a></li>
        </ul>
        <p class="menu-label">
            Groups
        </p>
        <ul class="menu-list">
            <li><a class="<?php if($page=='create'){echo 'is-active';}?>" href="createTeam.php">Create a Group</a></li>
            <li><a class="<?php if($page=='manage'){echo 'is-active';}?>" href="selectTeam.php">Manage Your Groups</a></li>
            <li><a class="<?php if($page=='e'){echo 'is-active';}?>" href="#">Disband a Group</a></li>
        </ul>
    </aside>
</div>