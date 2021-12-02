<template>
    <div class="compamyList">
        <div class="cates">
            <el-row>
                <el-col class="box" :span="6"  v-for="(item ,index) in list" :key="index"><echartsBox :option="makeOption(item)"></echartsBox></el-col>
            </el-row>
        </div>
    </div>
</template>
<script>

import common from '@/components/common'
import echartsBox from './echartsBox'

export default {
    extends:common,
    name: 'compamyList',
    components:{
        'echartsBox':echartsBox,
    },
    data:function(){
        return {
            list: [
                {name: '隆基股份', code: '300300', data: {}},
                {name: '隆基股份', code: '300300', data: {}},
                {name: '隆基股份', code: '300300', data: {}},
                {name: '隆基股份', code: '300300', data: {}},
                {name: '隆基股份', code: '300300', data: {}},
            ]
        }
    },
    methods:{
        makeOption: makeOption
    },
}

//内容改变时
function makeOption(item)
{
    return {
        title: {
            text: item.name + '(' + item.code + ')',
        },
        tooltip: {},
        xAxis: {
            data: ['衬衫', '羊毛衫', '雪纺衫', '裤子', '高跟鞋', '袜子']
        },
        yAxis: {},
        series: [
            {
                name: '销量',
                type: 'line',
                data: [5, 20, 36, 10, 10, 20]
            }
        ]
    }
}


</script>
<style lang="scss" scoped>
.compamyList {
    min-width: 1100px;
    background: #DDD6CC;
    width: 100%;
    margin: 20px auto 0px;
    .cates {
        min-width: 800px;margin: 100px 50px;
        .box {
            padding: 5px;
        }
    }
}
</style>

