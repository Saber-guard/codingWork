<template>
  <div class="components-uploadImg">
    <el-upload
      class="avatar-uploader"
      :action="action"
      :data="data"
      :before-upload="beforeUpload"
      :show-file-list="true"
      :list-type="list_type"
      :file-list="pic_list_show"
      :limit="limit"
      :on-success="uploadSuccess"
      :before-remove="deleteOne">
      <i class="el-icon-plus avatar-uploader-icon"></i>
    </el-upload>
  </div>
</template>
<script>
import md5 from 'js-md5'
import common from '@/components/common'

/*
* 上传图片组件
* 对外接口：
* pic_list:已上传图片列表,如果是单个图片也可以是该图片的地址
* limit:最大上传数目
* list_type:已上传图片展示方式：text/picture/picture-card
* pic_list_update（事件）:文件列表改变时的回调函数
* */
export default {
  extends:common,
  name: 'uploadImg',
  created: function(){
    this.getOssSig()
  },
  props:{
    pic_list:{
      default:function(){return []}
    },
    limit:{
      default:1
    },
    list_type:{
      default:"picture-card"
    },
  },
  data:function(){
    return {
      action:'',//上传地址由后端签名接口获得
      data:{},
    }
  },
  computed:{
    pic_list_show:function(){
      let list = []
      if (typeof this.pic_list == 'Array'){
        for (var i in this.pic_list) {
          list.push({url:this.pic_list[i]})
        }
      } else {
         if (this.pic_list) {
           list = [{url:this.pic_list}]
         }

      }
      return list
    }
  },
  methods:{
    getOssSig:getOssSig,
    beforeUpload:beforeUpload,
    uploadSuccess:uploadSuccess,
    getPath:getPath,
    getFilename:getFilename,
    deleteOne:deleteOne,
  },
}

//上传前回调
function beforeUpload(file){
  //生成上传文件目录和名字
  this.data.key = this.getPath() + this.getFilename(file.name)
  this.getOssSig()
}

//获取oss的签名
function getOssSig(){

  this.$axios({
    method:"get",
    url:'system/upload_sig',

  }).then(function (response) {
    let data = response.data
    if (data.errno == 0) {
      this.data.OSSAccessKeyId =  data.data.OSSAccessKeyId
      this.data.policy = data.data.policy
      this.data.signature = data.data.signature
      this.data.expire = data.data.expire
      this.action = data.data.host //上传地址
      return true

    } else {
      return false
    }
  }.bind(this))
}

//上传成功回调函数
function uploadSuccess(res, file){
  let imagePath = this.data.key
  let imageUrl = this.action + '/' + this.data.key
  //获取访问url
  this.$axios({
    method:"get",
    url:'system/file_url',
    params:{
      path:imagePath
    },

  }).then(function (response) {
    let data = response.data

    if (typeof this.pic_list == 'Array') {
      this.pic_list.push(imageUrl)
    } else {
      this.$emit('pic_list_update',{pic_list:imageUrl})
    }

  }.bind(this))

}

//生成上传文件路径
function getPath(){

  let path = 'pic'

  let dateObj = new Date();
  let mon = dateObj.getMonth() + 1
  let day = dateObj.getDate()
  let date = dateObj.getFullYear() + "/" + (mon<10?"0"+mon:mon) + "/" +(day<10?"0"+day:day)

  path += '/' + date + '/'
  return path
}

//生成文件名
function getFilename(old_name){

  let ext = old_name.split('.')[1]
  ext = ext ? ext : ''
  let timestamp = new Date().getTime()
  let rand = Math.random()
  return md5((timestamp + rand).toString()) + '.' + ext
}

// 删除文件列表中的一个
function deleteOne(file, fileList){

  if (typeof this.pic_list == 'Array') {
    this.$func.pop_one(file.url,this.pic_list)
 } else {
   this.$emit('pic_list_update',{pic_list:''})
 }
  return true
}


</script>
<style lang="scss" scoped>
.components-uploadImg{
  .avatar-uploader{
    .el-upload{
      border: 1px dashed #d9d9d9;
      border-radius: 6px;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      .avatar-uploader-icon{
        font-size: 28px;
        color: #8c939d;
        width: 148px;
        height: 148px;
        line-height: 148px;
        text-align: center;
      }
      .avatar {
        width: 178px;
        height: 178px;
        display: block;
      }
    }
    .el-upload:hover{
      border-color: #409EFF;
    }
  }
}
</style>

