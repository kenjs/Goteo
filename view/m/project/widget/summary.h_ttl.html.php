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

use Goteo\Model\Project\Category,
    Goteo\Model\Project\Skill,
    Goteo\Library\Text;

$project = $this['project'];

$categories = Category::getNames($project->id);
$skills = Skill::getNames($project->id);

$level = (int) $this['level'] ?: 3;
?>
    <?php  if (count($project->gallery) > 1) : ?>
		<script type="text/javascript" >
			$(function(){
				$('#prjct-gallery').slides({
					container: 'prjct-gallery-container',
					paginationClass: 'slderpag',
					generatePagination: false,
					play: 0
				});
			});
		</script>
    <?php endif; ?>

<div class="widget project-summary h_ttl">
    
    <h<?php echo $level ?>><?php echo htmlspecialchars($project->name) ?></h<?php echo $level ?>>

    <div class="project-subtitle"><?php echo htmlspecialchars($project->subtitle) ?></div>
    <div class="wants-skills">
        スキル: <?php
        // スキル表示
        if (!empty($skills)):
            foreach( $skills as $_skill_id => $_skill_name):
                ?>
                <a href=""><?php echo $_skill_name ?></a>
            <?
            endforeach;
        endif;
        ?>
    </div>
    <div class="categories"><h3><?php echo Text::get('project-view-categories-title'); ?></h3>
        <?php $sep = ''; foreach ($categories as $key=>$value) :
            echo $sep.'<a href="/discover/results/'.$key.'">'.htmlspecialchars($value).'</a>';
            $sep = ', '; endforeach; ?>
    </div>

</div>