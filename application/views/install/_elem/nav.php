<div class="board-inner">
    <ul class="nav nav-tabs" id="myTab" style="padding-left: 140px">
        <div class="liner"></div>
        <?php
        if(!isset($_GET['page'])) {
            echo '<li class="active">';
        }
        else
        {
            echo '<li>';
        }
        ?>
            <a title="Welcome">
              <span class="round-tabs one">
                    <i class="glyphicon glyphicon-home"></i>
              </span>
            </a>
        </li>

        <?php
        if(isset($_GET['page']) && $_GET['page'] == '1') {
            echo '<li class="active">';
        }
        else
        {
            echo '<li>';
        }
        ?>
            <a title="Database settings">
             <span class="round-tabs two">
                <i class="fa fa-database"></i>
             </span>
            </a>
        </li>
        <?php
        if(isset($_GET['page']) && $_GET['page'] == '2') {
            echo '<li class="active">';
        }
        else
        {
            echo '<li>';
        }
        ?>
            <a title="Create admin user">
                <span class="round-tabs three">
                  <i class="glyphicon glyphicon-user"></i>
                </span>
            </a>
        </li>

        <?php
        if(isset($_GET['page']) && $_GET['page'] == '3') {
            echo '<li class="active">';
        }
        else
        {
            echo '<li>';
        }
        ?>
            <a title="Success">
                <span class="round-tabs five">
                    <i class="glyphicon glyphicon-ok"></i>
                </span>
            </a>
        </li>

    </ul>
</div>