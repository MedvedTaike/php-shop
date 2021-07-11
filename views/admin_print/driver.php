<?php include(ROOT.'/views/pattern/header_print.php'); ?>
<div class="padding_inner">
    <p>Дата : <?php echo Order::getDateOff(); ?></p>
    <table>
         <tr>
            <th class="center">№</th>
            <th class="left">Торговая точка</th> 
            <th class="left">Адрес</th>
            <th class="center">Имя клиента</th>
            <th class="left">Телефон</th>
            <th class="left">Сумма</th>
        </tr>
        <?php $i = 1; $total = 0; ?>
        <?php foreach($ordersList as $list): ?>
        <tr>
            <td class="center"><?php echo $i; $i++ ;?></td>
            <td class="left"><?php echo $list['point']; ?></td>
            <td class="left"><?php echo $list['address']; ?></td>
            <td class="center"><?php echo $list['name']; ?></td>
            <td class="left"><?php echo $list['phone']; ?></td>
            <td class="left"><?php echo $list['total']; $total += $list['total']; ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td></td>
            <td colspan="4" class="left"> Общий итог</td>
            <td class="left"><?php echo $total; ?></td>
        </tr>
    </table>
</div>