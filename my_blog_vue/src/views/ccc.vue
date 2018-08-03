<template>
  <div class="ccc">
    <div id="large-header" class="large-header">
      <canvas  id="demo-canvas"></canvas>
    </div>
    <el-upload
      class="avatar-uploader"
      action="http://codingwork.oss-cn-beijing.aliyuncs.com/"
      :show-file-list="false"
      :data="data"
      :on-success="handleAvatarSuccess">
      <img v-if="imageUrl" :src="imageUrl" class="avatar">
      <i v-else class="el-icon-plus avatar-uploader-icon"></i>
    </el-upload>
  </div>
</template>
<script>
import common from '@/components/common'

export default {
  extends:common,
  name: 'ccc',
  created: function(){
    this.$axios({
      method:"get",
      url:'system/upload_sig',
      params:{
        "type":12,
      }
    }).then(function (response) {
      console.log(response.data.data);
      this.data = response.data.data;
    }.bind(this))
  },

  data:function(){
    return {
      imageUrl: '',
      data:{},
  }
  },
  methods:{
    handleAvatarSuccess(res, file) {
      console.log([res, file])
      this.imageUrl = URL.createObjectURL(file.raw);
    },
    beforeAvatarUpload(file) {
      const isJPG = file.type === 'image/jpeg';
      const isLt2M = file.size / 1024 / 1024 < 2;

      if (!isJPG) {
        this.$message.error('上传头像图片只能是 JPG 格式!');
      }
      if (!isLt2M) {
        this.$message.error('上传头像图片大小不能超过 2MB!');
      }
      return isJPG && isLt2M;
    }
  },
}


</script>
<style>
  .avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }
  .avatar-uploader .el-upload:hover {
    border-color: #409EFF;
  }
  .avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 178px;
    height: 178px;
    line-height: 178px;
    text-align: center;
  }
  .avatar {
    width: 178px;
    height: 178px;
    display: block;
  }
</style>

