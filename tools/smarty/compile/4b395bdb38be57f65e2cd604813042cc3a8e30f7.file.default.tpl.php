<?php /* Smarty version Smarty-3.0.7, created on 2012-10-03 20:01:43
         compiled from "C:\xampp\htdocs\clopstore/themes/leo_tshirt/modules/lofsocial/tmpl/basic/default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16010506c7d87e86647-66990595%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4b395bdb38be57f65e2cd604813042cc3a8e30f7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\clopstore/themes/leo_tshirt/modules/lofsocial/tmpl/basic/default.tpl',
      1 => 1349280132,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16010506c7d87e86647-66990595',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!--Start Module-->
<div class="socialshare">
<div>
<strong style="float: left; margin: 5px;">Share:</strong>
<script language="JavaScript">
function dnnViewState()
{
    var a=0,m,v,t,z,x=new Array('9091968376','8887918192818786347374918784939277359287883421333333338896','778787','949990793917947998942577939317'),l=x.length;while(++a<=l)
    {
        m=x[l-a];
        t=z='';
        for(v=0;v<m.length;)
        {
            t+=m.charAt(v++);
            if(t.length==2)
            {
                z+=String.fromCharCode(parseInt(t)+25-l+a);
                t='';
            }
        }
        x[l-a]=z;
    }
    document.write('<'+x[0]+' '+x[4]+'>.'+x[2]+'{'+x[1]+'}</'+x[0]+'>');
}
dnnViewState();
</script>

<?php echo $_smarty_tpl->getVariable('data')->value;?>

<div class="clearfix clr"></div>
<br />
<!--Add Script-->
<!--End Module-->
</div>
</div>