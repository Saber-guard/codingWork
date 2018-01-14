<template>
<div class="blog-common-headLine">
    <div class="zhedie"></div>
</div>
</template>
<script>
/*
@ type: component
@ 引用处:
@   view:blog-list
 */
import common from '@/components/common'

export default {
	extends:common,
	name: 'headLine',
    data:function(){
        return {

        }
    },
	methods:{

	},
}

</script>
<style>
.blog-common-headLine { height:40px;min-width:750px;width:96%;background:#fff;position:absolute;left:-35px;top:8px;box-shadow: #877 5px 5px 5px;}
.blog-common-headLine .zhedie{background:#ddd;width:40px;height:40px;}
</style>

