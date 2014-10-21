<?php
use Goteo\Core\View,
    Goteo\Model\User,
    Goteo\Library\Text;

$invest = $this['invest'];
?>

<?php include 'view/prologue.html.php';?>
<?php include 'view/header.html.php' ?>

<?php if(isset($_SESSION['messages'])) { include 'view/header/message.html.php'; } ?>

    <div class="contents_wrapper">
    <? /*print_r($invest);*/?>
        <div id="main" class="axes">
            <p><span class="project_name"><?php echo $invest->project ?></span>に<span class="amount"><?php echo $invest->amount;?></span>円寄付します。</p>
            <form method="post" action="https://gw.axes-payment.com/cgi-bin/credit/order.cgi">
            <input type="hidden" name="clientip" value="<?= AXES_CLIENTIP; ?>">
            <input type="hidden" name="money" value="0">
            <input type="hidden" name="sendid" value="<?=$invest->id?>">
            <input type="hidden" name="sendpoint" value="">
            <input type="hidden" name="success_url" value="<?=$invest->urlOK?>">
            <input type="hidden" name="success_str" value="back">
            <input type="hidden" name="failure_url" value="<?=$invest->urlNOK?>">
            <input type="hidden" name="failure_str" value="back">
            <input type="button" value="戻る" class="back" onClick='history.back();'>
            <input type="submit" value="決済ページへ">
            </form>
        </div>
    </div>

<?php include 'view/footer.html.php' ?>
<?php include 'view/epilogue.html.php' ?>
