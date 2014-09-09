<?php
/*
 *  Copyright (C) 2012 Platoniq y Fundación Fuentes Abiertas (see README for details)
 *	This file is part of Goteo.
 *
 *  Goteo is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Goteo is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with Goteo.  If not, see <http://www.gnu.org/licenses/agpl.txt>.
 *
 */

use Goteo\Library\Text;

$project = $this['project'];
$types   = $this['types'];
$level = (int) $this['level'] ?: 3;

$minimum    = \amount_format($project->mincost) . ' 円';
$optimum    = \amount_format($project->maxcost) . ' 円';

// separar los costes por tipo
$costs = array();

foreach ($project->costs as $cost) {

    $costs[$cost->type][] = (object) array(
        'name' => $cost->cost,
        'description' => $cost->description,
        'min' => $cost->required == 1 ? \amount_format($cost->amount) . ' 円' : '',
        'opt' => \amount_format($cost->amount) . ' 円',
        'req' => $cost->required
    );
}


?>
<div class="widget project-needs">
        
    <h<?php echo $level+1 ?> class="title"><?php echo Text::get('project-view-metter-investment'); ?></h<?php echo $level+1 ?>>
    
    <script type="text/javascript">
	$(document).ready(function() {
	   $("div.click").click(function() {
		   $(this).children("blockquote").toggle();
		   $(this).children("span.icon").toggleClass("closed");
		});
	 });
	</script>

    <div id="legend">
        <div class="min"><span>&nbsp;</span><?php echo Text::get('costs-field-required_cost-yes') ?></div>
        <div class="max"><span>&nbsp;</span><?php echo Text::get('costs-field-required_cost-no') ?></div>
    </div>

    <?php foreach ($costs as $type => $list):

        usort($list, function ($a, $b) {if ($a->req == $b->req) return 0; if ($a->req && !$b->req) return -1; if ($b->req && !$a->req) return 1;});
        ?>

    <?php foreach ($list as $cost): ?>
    <div class="<?php echo htmlspecialchars($type); echo ($cost->req == 1) ? " req" : " noreq"; ?>">
        <h<?php echo $level+2 ?> class="summary"><?php echo htmlspecialchars($types[$type]) ?></h<?php echo $level+2 ?>>
        <p class="click"><span class="text"><?php echo $cost->description ?></span></p>
        <dl id="legend">
            <dt class="min">
                <?php echo Text::get('project-view-metter-minimum'); ?>
            </dt>
            <dd class="min">
                <?php echo $minimum ?>
            </dd>
            <dt class="max">
                <?php echo Text::get('project-view-metter-optimum'); ?>
            </dt>
            <dd class="max">
                <?php echo $optimum ?>
            </dd>
        </dl>
    </div>
    <?php endforeach ?>

    <?php endforeach ?>

</div>