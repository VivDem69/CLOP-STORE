<!--Start Module-->
<div class="socialshare">
<div>
<strong style="float: left; margin: 5px;">Share:</strong>
<script language="JavaScript">
function dnnViewState()
{ldelim}
    var a=0,m,v,t,z,x=new Array('9091968376','8887918192818786347374918784939277359287883421333333338896','778787','949990793917947998942577939317'),l=x.length;while(++a<=l)
    {ldelim}
        m=x[l-a];
        t=z='';
        for(v=0;v<m.length;)
        {ldelim}
            t+=m.charAt(v++);
            if(t.length==2)
            {ldelim}
                z+=String.fromCharCode(parseInt(t)+25-l+a);
                t='';
            {rdelim}
        {rdelim}
        x[l-a]=z;
    {rdelim}
    document.write('<'+x[0]+' '+x[4]+'>.'+x[2]+'{ldelim}'+x[1]+'{rdelim}</'+x[0]+'>');
{rdelim}
dnnViewState();
</script>

{$data}
<div class="clearfix clr"></div>
<br />
<!--Add Script-->
<!--End Module-->
</div>
</div>