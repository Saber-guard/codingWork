<template>
<footer class="blog-common-foot">
    <div class="footavatar">
        <img src="/static/images/1231.jpg" class="footphoto">
        <ul class="footinfo">
            <p class="fname"><a href="/dancesmile" >果冻悠哉</a>  </p>
            <p class="finfo">现居：北京朝阳</p>
            <p></p>
        </ul>
    </div>
    <div class="Copyright">
        <ul>
            <a href="http://www.beian.miit.gov.cn">晋ICP备16010493号</a>
        </ul>
        <p><br /></p>
    </div>
 </footer>
</template>
<script>
/*
@ type: component
@ 引用处:
@   view:blog
 */
import common from '@/components/common'

export default {
	extends:common,
	name: 'footfoot',
	methods:{

	},
}

</script>
<style lang="scss" scoped>
.blog-common-foot {
  min-width: 1100px;
  border-top: 9px solid #8E6D56;
  background: #242221;
  position: relative;
  width: 100%;
  z-index:10000;
  .footavatar {
    width: 700px;
    margin: auto;
    position: relative;
    color: #666;
    img{ height:110px}
  }

  .footphoto { position: absolute; top: -58px; left: 20px; display: block; border: #8E6D56 5px solid; }
  .footinfo { display: block; padding: 0 0 0 160px }
  .fname {
    color: #f16e50;
    margin-top: 16px;
    font-size: 18px;
    line-height: 28px;
    a { color: #f16e50; }
  }

  .finfo { line-height: 22px; }

  .visitor {
    width: 800px;
    margin: 40px auto 0;
    clear: both;
    border-top: 1px solid #32302e;
    padding-top: 40px;
    overflow: hidden;
    h2 { color: #fff; font-size: 14px; font-weight: normal; padding: 0 20px 0 }
    ul {
      padding: 20px;
      li{
        img { width: 78px; height: 78px; display: block; border: #FFF 2px solid }
        a { float: left; margin-right: 10px }
        a:hover { opacity: 0.5 }
      }
    }
  }

  .Copyright {
    text-align: center;
    color: #959595;
    margin: 40px 0 0;
    ul{
      a { color: #f16e50; display: inline; padding: 0 10px; }
      // a:nth-child(-n+3) { border-right: #999 1px solid }
      a:hover { color: #ff8b70; }
    }
  }

}

</style>

