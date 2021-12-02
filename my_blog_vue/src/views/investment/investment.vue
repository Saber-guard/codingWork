<template>
    <div class="investment">
        <headhead v-if="hasHead"></headhead>
        <div><router-view /></div>
        <footfoot v-if="hasFoot"></footfoot>
    </div>
</template>
<script>

    import common from '@/components/common'
    import head from '@/views/blog/common/head'
    import foot from '@/views/blog/common/foot'

    export default {
        extends:common,
        name: 'investment',
        data:function(){
            return {
                hasHead:true,//是否显示头部
                hasFoot:true,//是否显示底部
            }
        },
        methods:{
            openFoot:openFoot,
            openHead:openHead,
        },
        components:{
            headhead:head,
            footfoot:foot,
        },
    }
    //显示头部
    function openHead(status)
    {
        this.hasHead = status
    }
    //显示底部
    function openFoot(status)
    {
        this.hasFoot = status
    }
</script>
<style>

</style>

