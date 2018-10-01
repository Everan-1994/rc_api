<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>仁才地产</title>
    <meta name="viewport"
          content="initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/common.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/style.css') }}?v=2">
</head>

<style>
    .titles {
        width: 88%;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .bodys {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        overflow: hidden;
    }

    .btn-page {
        width: 47%;
        height: 30px;
        border-radius: 3px;
        background-color: #3db1fa;
        color: #fff;
    }

    .li33 {
        width: 33% !important;
    }

    .edit-pwd {
        max-width: 45px;
        position: fixed;
        bottom: 75px;
        right: 2%;
    }

    .need-logout {
        max-width: 45px;
        position: fixed;
        bottom: 30px;
        right: 2%;
    }
</style>

<body>
<div id="app">
    <div class="xfdsctz_f">
        <ul>
            <li class="addys_f2" @click="getList">文章列表</li>
            <li @click="getMsg">客户留言</li>
        </ul>
    </div>
    <!--占固定定位的块-->
    <div class="occupy_f"></div>

    <!--显示区域-->
    <div class="display_f">
        <!--包的内容-->
        <div class="display_f_in">
            <!--文章列表-->
            <div id="qrcode" v-show="qrcodes" style="text-align: center; padding: 10px;"></div>
            <div class="fourcp_1">
                <!--一条开始-->
                <div class="novice_zs_f_in" v-for="(article, index) in articleList" :key="index"
                     style="margin-bottom: 6px;">
                    <!--left-->
                    <div class="novice_zs_f_in_l">
                        <!--top-->
                        <div class="novice_zs_f_in_l_top" style="margin-bottom: 10px;">
                            <img src="home/title.png"/>
                            <span class="titles" v-text="article.title" @click="shareQrcode(article.id)"></span>
                        </div>
                        <!--bottom-->
                        <div class="novice_zs_f_in_l_bottom">
                            <ul>
                                <li class="mark1_f"
                                    style="width: 70% !important; margin-left: 10px; border-top: 1px dashed #EEEEEE;">
                                    <div style="font-size: 12px; padding: 10px 10px 0 10px;"
                                         v-html="article.title"></div>
                                </li>
                                <li class="mark3_f"
                                    style="width: 20% !important; font-size: 12px; padding: 7% 0 0 10px; border-top: 1px dashed #EEEEEE; ">
                                    <div>
                                        <span v-text="article.time"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--right-->
                    <a href="javascript:;" @click="detail(article.id)">
                        <div class="novice_zs_f_in_r">
                            <span style="margin-top: 85%;color: #fff;">预览</span>
                        </div>
                    </a>
                </div>
                <div style="width: 100%; text-align: center;" v-show="showPage">
                    <button class="btn-page" @click="more_prev" ref="more_prev">上一页</button>
                    <button class="btn-page" @click="more_next" ref="more_next">下一页</button>
                </div>
            </div>
            <!--客户留言-->
            <div class="fourcp_1">
                <!--一条开始-->
                <div class="novice_zs_f_in" v-for="(message, index) in messageList" :key="index"
                     style="margin-bottom: 6px;">
                    <!--left-->
                    <div class="novice_zs_f_in_l">
                        <!--top-->
                        <div class="novice_zs_f_in_l_top" style="margin-bottom: 10px;">
                            <img src="home/title.png"/>
                            <span class="titles"><i v-text="message.title"></i></span>
                        </div>
                        <!--bottom-->
                        <div class="novice_zs_f_in_l_bottom">
                            <ul>
                                <li class="mark1_f">
                                    <em>姓名</em>
                                    <p style="text-align: center;" v-text="message.name"></p>
                                </li>
                                <li class="mark2_f">
                                    <em>联系方式</em>
                                    <p style="text-align: center;">
                                        <a :href="message.tphone" v-text="message.phone"></a>
                                    </p>
                                </li>
                                <li class="mark3_f" style="width: 50% !important;">
                                    <em @click="dmessage(message.home_type)" v-text="message.ltime"></em>
                                    <p class="titles" style="text-align: center;" v-text="message.home_type"></p>
                                    {{--<p class="titles" style="text-align: center;" v-if="message.remake"--}}
                                    {{--v-text="message.remake"></p>--}}
                                    {{--<p style="text-align: center;" v-else> -- </p>--}}
                                </li>
                                {{--<li class="mark3_f" style="color: #009f95;">--}}
                                {{--<em v-text="message.ltime"></em>--}}
                                {{--<p class="titles" style="text-align: center;" v-text="message.htime"--}}
                                {{--v-if="message.status == 1"></p>--}}
                                {{--<p class="titles" style="text-align: center;" v-else> -- </p>--}}
                                {{--</li>--}}
                            </ul>
                        </div>
                    </div>
                    <!--right-->
                    <a href="javascript:;" v-if="message.status == 1" @click="remaked(message.remake, message.htime)">
                        <div class="novice_zs_f_in_r">
                            <span style="margin-top: 66%;color: #fff;">已回访</span>
                        </div>
                    </a>
                    <a href="javascript:;" @click="remake(message.id)" v-else>
                        <div class="novice_zs_f_in_r" style="background: red !important;">
                            <span style="margin-top: 66%;color: #fff;">待回访</span>
                        </div>
                    </a>
                </div>
                <div style="width: 100%; text-align: center;" v-show="showMPage">
                    <button class="btn-page" @click="more_mprev" ref="more_mprev">上一页</button>
                    <button class="btn-page" @click="more_mnext" ref="more_mnext">下一页</button>
                </div>
            </div>
            {{--修改密码 & 退出登陆--}}
        </div>
        <div>
            <image src="home/logout.png" class="need-logout" @click="need_logout" alt="退出系统"/>
            <image src="home/edit_pwd.png" class="edit-pwd" @click="edit_pwd" alt="修改密码"/>
        </div>
    </div>
</div>
<script src="{{ asset('layer/jquery.js') }}"></script>
<script src="{{ asset('home/js/jquery.qrcode.min.js') }}"></script>
<script src="{{ asset('home/js/moment.min.js') }}"></script>
<script src="{{ asset('home/js/public.js') }}"></script>
<script src="{{ asset('layer/layer.js') }}"></script>
<script src="{{ asset('login/js/vue.js') }}"></script>
<script src="{{ asset('layer/axios.js') }}"></script>
<script src="{{ asset('layer/jwt.js') }}"></script>
<script>
    axios.defaults.headers['Authorization'] = getToken();
    moment.locale('zh-cn');
    new Vue({
        el: '#app',
        data() {
            return {
                qrcodes: false,
                total: 0,
                page: 1,
                pageSize: 5,
                showPage: false,
                articleList: [],
                m_total: 0,
                m_page: 1,
                m_pageSize: 5,
                showMPage: false,
                messageList: []
            }
        },
//        watch: {
//            page(value) {
//                console.log('page', value);
//            }
//        },
        created() {
            this.getArticleList();
        },
        methods: {
            getList() {
                this.messageList = [];
                this.getArticleList();
            },
            getArticleList() {
                let _this = this;
                let params = {
                    page: _this.page,
                    pageSize: _this.pageSize
                };
                axios.get('api/article', {params}).then(response => {
                    _this.articleList = response.data.data;
                    _this.total = response.data.meta.total;
                    if (_this.total <= _this.pageSize) {
                        _this.showPage = false;
                    } else {
                        _this.showPage = true;
                    }
                    _this.articleList.forEach((v, i) => {
                        _this.articleList[i].time = moment(v.created_at, format = 'YYYYMMDD H:mm:ss').fromNow();
                    });
                }).catch(error => {
                    if (error.response.status == 401) {
                        layer.confirm('你的登陆信息已过期，请重新登陆。', {
                            icon: 0,
                            title: '温馨提示',
                            closeBtn: 0,
                            btn: ['朕知道了']
                        }, function () {
                            removeToken();
                            removeUser();
                            removeUserId();
                            removeUserPhone();
                            window.location.href = "{{ url('wap') }}";
                        });
                    } else {
                        layer.msg(error.response.data.error || '系统出错', {icon: 5});
                    }
                });
            },
            getMsg() {
                this.messageList = [];
                this.getMessageList();
            },
            getMessageList() {
                let _this = this;
                let params = {
                    page: _this.m_page,
                    pageSize: _this.m_pageSize,
                };
                axios.get('api/message', {params}).then(response => {
                    _this.messageList = response.data.data;
                    _this.m_total = response.data.meta.total;
                    if (_this.m_total <= _this.m_pageSize) {
                        _this.showMPage = false;
                    } else {
                        _this.showMPage = true;
                    }
                    _this.messageList.forEach((v, i) => {
                        _this.messageList[i].ltime = moment(v.created_at, format = 'YYYYMMDD H:mm:ss').fromNow() + '的留言';
                        _this.messageList[i].htime = moment(v.updated_at, format = 'YYYYMMDD H:mm:ss').fromNow();
                        _this.messageList[i].tphone = `tel:${v.phone}`;
                    });
                }).catch(error => {
                    if (error.response.status == 401) {
                        layer.confirm('你的登陆信息已过期，请重新登陆。', {
                            icon: 0,
                            title: '温馨提示',
                            closeBtn: 0,
                            btn: ['朕知道了']
                        }, function () {
                            removeToken();
                            removeUser();
                            removeUserId();
                            removeUserPhone();
                            window.location.href = "{{ url('wap') }}";
                        });
                    } else {
                        layer.msg(error.response.data.error || '系统出错', {icon: 5});
                    }
                });
            },
            more_next() {
                if (this.total > (this.pageSize * this.page)) {
                    this.$refs.more_prev.disabled = false;
                    this.page++;
                    this.getArticleList();
                } else {
                    this.$refs.more_next.disabled = true;
                    layer.msg('没有更多数据了。');
                }
            },
            more_prev() {
                if (this.page > 1) {
                    this.$refs.more_next.disabled = false;
                    this.page--;
                    this.getArticleList();
                } else {
                    this.$refs.more_prev.disabled = true;
                    layer.msg('已经是第一页了。');
                }
            },
            more_mnext() {
                if (this.m_total > (this.m_pageSize * this.m_page)) {
                    this.$refs.more_mprev.disabled = false;
                    this.m_page++;
                    this.getMessageList();
                } else {
                    this.$refs.more_mnext.disabled = true;
                    layer.msg('没有更多数据了。');
                }
            },
            more_mprev() {
                if (this.m_page > 1) {
                    this.$refs.more_mnext.disabled = false;
                    this.m_page--;
                    this.getMessageList();
                } else {
                    this.$refs.more_mprev.disabled = true;
                    layer.msg('已经是第一页了。');
                }
            },
            copy_url(id) {
                let share_id = getUserId();
                let phone = getUserPhone();
                let names = getUser();
                let share_name = `${names.substring(0, 1)}经理`;
                let url = `https://rc.lzdu.com/preview?id=${id}&share_id=${share_id}&phone=${phone}&share_name=${share_name}`;
                var oInput = document.createElement('input');
                oInput.value = url;
                document.body.appendChild(oInput);
                oInput.select(); // 选择对象
                document.execCommand("Copy"); // 执行浏览器复制命令
                oInput.className = 'oInput';
                oInput.style.display = 'none';
                layer.msg('复制链接成功');
            },
            detail(id) {
                let share_id = getUserId();
                let phone = getUserPhone();
                let names = getUser();
                let share_name = `${names.substring(0, 1)}经理`;
                let url = `https://rc.lzdu.com/preview?id=${id}&share_id=${share_id}&phone=${phone}&share_name=${share_name}`;

                window.location.href = url;
            },
            shareQrcode(id) {
                const _this = this;
                _this.qrcodes = true;
                let share_id = getUserId();
                let phone = getUserPhone();
                let names = getUser();
                let share_name = `${names.substring(0, 1)}经理`;
                let urls = _this.utf16to8(`https://rc.lzdu.com/preview?id=${id}&share_id=${share_id}&phone=${phone}&share_name=${share_name}`);

                $('#qrcode').qrcode({
                    width: 170,
                    height: 170,
                    text: urls
                });
                layer.open({
                    type: 1,
                    title: '温馨提示：可以截图分享',
                    shade: false,
                    content: $('#qrcode'), // 捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
                    cancel: function () {
                        $('#qrcode').html('');
                    }
                });
                this.qrcodes = false;
            },
            read(id) {
                let share_id = getUserId();
                let phone = getUserPhone();
                let names = getUser();
                let share_name = `${names.substring(0, 1)}经理`;

                let detail = layer.open({
                    type: 2,
                    title: '文章详情',
                    shadeClose: true,
                    shade: 0.8,
                    area: ['100%', '100%'],
                    content: `https://rc.lzdu.com/preview?id=${id}&share_id=${share_id}&phone=${phone}&share_name=${share_name}` //iframe的url
                });

                layer.full(detail);
            },
            dmessage(msg) {
                layer.alert(msg, {'title': '客户留言'});
            },
            remake(id) {
                let _this = this;
                layer.prompt({title: '随便写点备注，并确认', formType: 2}, function (text, index) {
                    layer.close(index);
                    axios.patch('api/message/remake', {
                        id: id,
                        remake: text,
                        status: 1
                    }).then(response => {
                        _this.getMessageList();
                        layer.msg('备注成功', {icon: 6});
                    }).catch(error => {
                        layer.msg('备注失败', {icon: 5});
                    })
                });
            },
            remaked(remake, htime) {
                layer.msg(`${htime}回复：${remake}`);
            },
            edit_pwd() {
                const _this = this;
                layer.prompt({title: '请输入新密码', formType: 0}, function (pass, index) {
                    layer.close(index);
                    _this.edit_pwd_do(pass);
                });
            },
            edit_pwd_do(pass) {
                const _this = this;
                let user_id = getUserId();
                axios.patch(`api/user/${user_id}/changePwd`, {new_pwd: pass}).then(response => {
                    layer.msg('密码修改成功', {icon: 6, time: 1000});
                    setTimeout(function () {
                        removeToken();
                        window.location.href = "{{ url('wap') }}";
                    }, 1500);
                }).catch(error => {
                    layer.msg('系统出错，请稍后再试。', {icon: 5});
                });
            },
            need_logout() {
                const _this = this;
                layer.confirm('确定退出系统吗？', {
                    title: '温馨提示',
                    btn: ['确定', '取消']
                }, function () {
                    _this.logout();
                });
            },
            logout() {
                axios.delete('api/logout').then(response => {
                    removeToken();
                    layer.msg('退出成功', {icon: 6});
                    setTimeout(function () {
                        window.location.href = "{{ url('wap') }}";
                    }, 1000);
                }).catch(error => {
                    removeToken();
                    layer.msg('退出成功', {icon: 6});
                    setTimeout(function () {
                        window.location.href = "{{ url('wap') }}";
                    }, 1000);
                });
            },
            utf16to8(str) {
                var out, i, len, c;
                out = "";
                len = str.length;
                for (i = 0; i < len; i++) {
                    c = str.charCodeAt(i);
                    if ((c >= 0x0001) && (c <= 0x007F)) {
                        out += str.charAt(i);
                    } else if (c > 0x07FF) {
                        out += String.fromCharCode(0xE0 | ((c >> 12) & 0x0F));
                        out += String.fromCharCode(0x80 | ((c >> 6) & 0x3F));
                        out += String.fromCharCode(0x80 | ((c >> 0) & 0x3F));
                    } else {
                        out += String.fromCharCode(0xC0 | ((c >> 6) & 0x1F));
                        out += String.fromCharCode(0x80 | ((c >> 0) & 0x3F));
                    }
                }
                return out;
            }
        }
    });
</script>
</body>
</html>



