<template>
    <div class="echartsBox">
        <div class="box" ref="box">
        </div>
    </div>
</template>
<script>

    import common from '@/components/common'
    import * as echarts from 'echarts'

    export default {
        extends:common,
        name: 'echartsBox',
        data:function(){
            return {
            }
        },
        props: ['option'],
        mounted: function(){
            var myChart = echarts.init(this.$refs.box);
            myChart.setOption(this.option);
        },
        methods:{

        },
    }
</script>
<style lang="scss" scoped>
    .echartsBox {
        background: #DDD6CC;
        width: 100%;
        .box {
            background: #000;
            width: 100%;
            height: 400px;
        }
    }
</style>

