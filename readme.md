### 修改用户信息
请求地址：`/user`  
请求方式：POST  
请求数据：
```
{
    "name": "名字",
    "sign": "一句话简介",
    "sex": "1"  // 性别，数字，1男，2女，0保密
}
```
成功返回数据：
```
{
    "status": "success",
    "message": "修改成功"
}
```

### 修改用户头像
请求地址：`/user/modifyAvatar`  
请求方式：POST  
请求数据：表单请求，键是 `avatar`，值是文件  

成功返回数据：
```
{
    "status": "success",
    "message": "修改成功"，
    "path": "storage/xxx/xxx/xxx.jpeg" // 上传的文件路径
}
```

### 修改用户封面
请求地址：`/user/modifyCover`  
请求方式：POST  
请求数据：表单请求，键是 `cover`，值是文件  

成功返回数据：
```
{
    "status": "success",
    "message": "修改成功"，
    "path": "storage/xxx/xxx/xxx.jpeg" // 上传的文件路径
}
```
