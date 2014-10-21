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

use Goteo\Core\View,
    Goteo\Library\Text,
    Goteo\Model,
    Goteo\Core\Redirection,
    Goteo\Library\Message,
    Goteo\Library\SuperForm;

define('ADMIN_NOAUTOSAVE', true);

$project = $this['project'];

if (!$project instanceof Model\Project) {
    Message::Error(Text::get('admin-projects-error-corruptproject'));
    throw new Redirection('/admin/projects');
}

$elements = array(
    'created' => array(
        'type'      => 'datebox',
        'title'     => Text::_('Fecha de creación'),
        'value'     => !empty($project->created) ? $project->created : null
    ),
    'updated' => array(
        'type'      => 'datebox',
        'title'     => Text::_('Fecha de enviado a revisión'),
        'value'     => !empty($project->updated) ? $project->updated : null
    ),
    'published' => array(
        'type'      => 'datebox',
        'title'     => Text::_('Fecha de inicio de campaña'),
        'subtitle'  => Text::_('(Segun esta fecha se calculan los días)'),
        'value'     => !empty($project->published) ? $project->published : null
    ),
    'success' => array(
        'type'      => 'datebox',
        'title'     => Text::_('Fecha de éxito'),
        'subtitle'  => Text::_('(marca fin de segunda ronda)'),
        'value'     => !empty($project->success) ? $project->success : null
    ),
    'closed' => array(
        'type'      => 'datebox',
        'title'     => Text::_('Fecha de cierre'),
        'value'     => !empty($project->closed) ? $project->closed : null
    ),
    'passed' => array(
        'type'      => 'datebox',
        'title'     => Text::_('Fecha de paso a segunda ronda'),
        'subtitle'  => Text::_('(marca fin de primera ronda)'),
        'value'     => !empty($project->passed) ? $project->passed : null
    )

);
?>
<div class="widget">

    <?php if (!empty($project->passed)) {
        echo '<p><span>' . Text::_('El proyecto terminará la primera ronda el día') . '：</span><strong>'.date('Y/m/d', strtotime($project->passed)).'</strong></p>';
        if ($project->passed != $project->willpass) {
                echo '<p><span>' . Text::_('Day minimum required amount is to be achieved') . '：</span><strong>'.date('Y/m/d', strtotime($project->willpass)).'</strong></p>';
        }
    } else {
        echo Text::_('El proyecto terminará la primera ronda el día') . '<strong>'.date('Y/m/d', strtotime($project->willpass)).'</strong>.';
    } ?>

</p>

    <p><?php echo Text::_('Cambiar las fechas puede causar cambios en los días de campaña del proyecto.'); ?></p>

    <form method="post" action="/admin/projects" >
        <input type="hidden" name="id" value="<?php echo $project->id ?>" />

<?php foreach ($elements as $id=>$element) : ?>
    <div id="<?php echo $id ?>">
        <h4><?php echo $element['title'] ?>:</h4>
        <?php echo new View('library/superform/view/element/datebox.html.php', array('value'=>$element['value'], 'id'=>$id, 'name'=>$id)); ?>
        <?php if (!empty($element['subtitle'])) echo $element['subtitle'].'<br />'; ?>
    </div>
        <br />
<?php endforeach; ?>

        <input type="submit" name="save-dates" value="<?php echo Text::_('Guardar'); ?>" />

    </form>
</div>
