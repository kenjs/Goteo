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
        <div id="main">
            <?php echo $invest->amount;?>円寄付します。
            <form method="post" action="https://gw.axes-payment.com/cgi-bin/credit/order.cgi">
            <input type="hidden" name="clientip" value="1019000507">
            <input type="hidden" name="money" value="0">
            <input type="hidden" name="sendid" value="123">
            <input type="hidden" name="sendpoint" value="">
            <input type="hidden" name="success_url" value="<?=$invest->urlOK?>">
            <input type="hidden" name="success_str" value="トップページへ1">
            <input type="hidden" name="failure_url" value="<?=$invest->urlNOK?>">
            <input type="hidden" name="failure_str" value="トップページへ2">
            <input type="submit" value="決済ページへ">
            </form>
        </div>
    </div>

<?php include 'view/footer.html.php' ?>
<?php include 'view/epilogue.html.php' ?>
