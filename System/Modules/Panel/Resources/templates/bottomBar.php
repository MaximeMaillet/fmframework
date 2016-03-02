<section class="panel_bottomBar">
    <a href="#" class="blocklink<?php echo (count($logs) > 0) ? '_notif' : '_empty'; ?>">
        <h2>Logs</h2>
        <div class="content">
            <ul>
                <?php
                // [datetime] (file) ; (line) :: content
                foreach($logs as $line) {
                    $arraydatas = explode('::', $line);
                    $arrayinfos = explode(' ; ', $arraydatas[0]);
                    echo'<li>'.$arrayinfos[0].' : '.$arraydatas[1].'
                        <ul>
                            <li>'.$arrayinfos[1].' - '.$arrayinfos[2].'</li>
                        </ul>
                    </li>';
                }
                ?>
            </ul>
        </div>
    </a>
    <a href="#" class="blocklink<?php echo (count($instances) > 0) ? '_notif' : '_empty'; ?>">
        <h2>Instances</h2>
        <div class="content">
            <ul class="parent">
                <?php
                foreach ($instances as $instance) {
                    if(is_array($instance))
                        echo '<li>'.$instance['parent'].'
                            <ul class="child">
                                <li>'.$instance['child'].'</li>
                            </ul>
                        </li>';
                    else
                        echo '<li>'.$instance.'</li>';
                }
                ?>
            </ul>
        </div>
    </a>
</section>