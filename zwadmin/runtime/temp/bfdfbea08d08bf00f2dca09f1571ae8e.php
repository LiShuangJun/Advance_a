<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:66:"D:\www\zwadmin\application\advance\view\index\service_details.html";i:1522313331;s:56:"D:\www\zwadmin\application\advance\view\common\base.html";i:1511767701;s:58:"D:\www\zwadmin\application\advance\view\common\header.html";i:1522663277;s:58:"D:\www\zwadmin\application\advance\view\common\footer.html";i:1524021854;}*/ ?>
<!doctype html>
<html lang="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php echo $site_title; ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
  <link rel="apple-touch-icon" href="apple-touch-icon.png">
  <!-- Place favicon.ico in the root directory -->
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/bower_components/bootstrap/dist/css/bootstrap.min.css?_=<?php echo $site_version; ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/flexslider.css?_=<?php echo $site_version; ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/font-awesome.min.css?_=<?php echo $site_version; ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/perfect-scrollbar.min.css?_=<?php echo $site_version; ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/DateTimePicker.css?_=<?php echo $site_version; ?>">
  <!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="./css/DateTimePicker-ltie9.min.css">
  <![endif]-->
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/app.css?_=<?php echo $site_version; ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/forms.css?_=<?php echo $site_version; ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/new.css?_=<?php echo $site_version; ?>">
  

<link rel="stylesheet" type="text/css" href="<?php echo $static_path; ?>/advance/css/sub_page.css?_=<?php echo $site_version; ?>">


</head>
<body class="loading">

  <div class="hide-image" style="display:none;">
    <img src="<?php echo $static_path; ?>/advance/img/001.jpg">
  </div>
  <div id="page-wrapper">
    <section id="preloader">
      <div class="loader" id="loader">
          <div class="loader-img"></div>
      </div>
    </section>
    
    <div class="top-nav clearfix">
      
      <a class="logo-wrapper" href="<?php echo url('/Allianz'); ?>">
        <span class="logo1 logo2"><img src="<?php echo $static_path; ?>/advance/img/logo-02.jpg" alt=""></span>
        <span class="logo1 "><img src="<?php echo $static_path; ?>/advance/img/logo3.png" alt=""></span>
      </a>
       <!--  <?php if($userid != 0): ?>
      <a class="login-wrapper" href="<?php echo url('Login/logout'); ?>"><?php echo mb_substr($minedata['user_name'],0,4,'utf-8'); ?>,退出</a>
       <?php else: ?>
        <a class="login-wrapper" href="<?php echo url('Login/index'); ?>">登录</a>
       <?php endif; ?> -->
       <div style="width:100%;height:35px;">
         <?php if($userid != 0): ?>
          <a style=" float: right;margin-top:0;margin-right: 50px;line-height: 35px;" class="login-wrapper" href="<?php echo url('Login/logout'); ?>"><?php echo mb_substr($minedata['user_name'],0,4,'utf-8'); ?>,退出</a>
           <?php else: ?>
            <a style="float: right;margin:0;line-height: 35px;" class="login-wrapper" href="<?php echo url('Login/index'); ?>">登录</a>
           <?php endif; ?>
    </div>
      <ul class="menu-wrapper clearfix" style="margin-top: 55px;">
         <?php if(is_array($service_list) || $service_list instanceof \think\Collection || $service_list instanceof \think\Paginator): $i = 0; $__LIST__ = $service_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sl): $mod = ($i % 2 );++$i;if(in_array(($sl['id']), explode(',',"1"))): ?>
         <li class="menubar menubar-<?php echo $sl['id']; ?>"><a href="<?php echo url('/Allianz/EMO/services/'.$sl['id']); ?>"><span class="bar-background"></span><span class="bar-text"><?php echo $sl['typename']; ?></span><span class="bottom-gradient"></span></a><span class="right-gradient"></span></li>

         <?php endif; endforeach; endif; else: echo "" ;endif; ?>

      </ul>
    </div>
    
    <div class="flex-container-outer-wrapper">
    <div class="flex-container-wrapper mb--l">
      <div class="flex-container">
        <div class="flexslider">
          <ul class="slides">
            <li>
              <img src="<?php echo $static_path; ?>/advance/img/001.jpg">
            </li>
            <li>
              <img src="<?php echo $static_path; ?>/advance/img/002.jpg">
            </li>
            <li>
              <img src="<?php echo $static_path; ?>/advance/img/003.jpg">
            </li>
          </ul>
        </div>
      </div>
      <div class="flex-mask">
        <div class="diagnose logvilad" >
          <div class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/diagnose.png" alt=""></div>
          <div class="diagnose-text">一键咨询</div>
        </div>
        <div class="flex-phone-wrapper">
          <span>400&#45;820&#45;7122</span>
        </div>
      </div>
    </div>
  </div>
    <div class="mobile-header mb--s mt--s">
      <div class="image-wrapper">
        <img src="<?php echo $static_path; ?>/advance/img/444.jpg" alt="">
      </div>
    </div>
    <div class="mobile-diagnose logvilad">
      <div class="diagnose-text">一键咨询</div>
    </div>


<?php if($service_id == 1): ?>
<!--服务1-->
<div class="expert-opinion-wrapper">
      <div class="expert-section expert-section-1">
         <h2 id="diagnose"><span class="title">诊疗意见</span></h2>
        <div class="expert-sub expert-sub-1">
          <h3><span>全球医学专家意见</span></h3>
          <div class="expert-feature-wrapper clearfix">
            <div class="expert-feature clearfix">
              <div class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/icon/1.png" alt=""></div>
              <div class="feature-caption">
                <span class="feature-title">
                经验丰富专案医生
                </span>
                <span>行医执照严格筛选</span>
                <span>平均执业10年以上</span>
              </div>
            </div>
            <div class="expert-feature clearfix">
              <div class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/icon/2.png" alt=""></div>
              <div class="feature-caption">
              <span class="feature-title">
              医学委员会
              </span>
              <span>全球范围匹配专家</span>
              </div>
            </div>
            <div class="expert-feature clearfix">
              <div class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/icon/3.png" alt=""></div>
              <div class="feature-caption">
              <span class="feature-title">
              国际顶级专家
              </span>
              <span class="special-caption">就个案问题针对性</span><!--
              --><span class="special-caption">出具书面意见报告</span>
              </div>
            </div>
            <div class="expert-feature clearfix">
              <div class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/icon/4.png" alt=""></div>
              <div class="feature-caption">
              <span class="feature-title">
              专案医生
              </span>
              <span class="special-caption">详尽解释，辅助决策，</span><!--
              --><span class="special-caption">定期跟进</span>
              </div>
            </div>
          </div>
        <!-- <h2 id="diagnose"><span class="title">诊疗意见</span></h2>
          <div class="new_moble" style="width:100%;height:auto;">
            <div class="moble_centent_left" ></div>
            <div class="moble_centent_right">
              <div class="moble_border_top" ></div>
              <div class="moble_text">对任何面临重大医疗决策的人来说，重要的是与医生一起沟通的时间。我们的专案医生会竭尽所能，帮助您了解病情并致力于为您最关心的问题提供最佳答案。</div>
              <div style="float:right;">
                <div class="moble_border_center" ></div>
                <div class="moble_border_bottom"></div>
              </div>
            </div>
         </div>
          <div style="clear:both "></div> -->
       <!--  <div class="expert-sub expert-sub-1">
          <h3><span>国际权威专家意见报告</span></h3>
         
          <div class="expert-feature-wrapper clearfix">
            <div class="expert-feature clearfix">
              <div class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/icon/1.png" alt=""></div>
              <div class="feature-caption">
                <span class="feature-title">
                专案医生
                </span>
                <span style="height:180px;display:inline-block;border:2px solid #017f4f;padding:16px;border-radius:3px;">我们将指派一位资深的专案医生与您对接，作为您的私人健康顾问，医生将充分收集您的病史资料，并帮助您罗列出需要专家建议的一系列重要问题</span>
              </div>
            </div>
            <div class="expert-feature clearfix">
              <div class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/icon/2.png" alt=""></div>
              <div class="feature-caption">
              <span class="feature-title">
              专家评估
              </span>
              <span style="height:180px;display:inline-block;border:2px solid #017f4f;padding:16px;border-radius:3px;">我们拥有覆盖全球范围的临床医疗委员会，在世界各地为您搜寻并鉴定顶级医疗专家。团队的通力合作将为您确定正确的诊断以及最佳的治疗计划。</span>
              </div>
            </div>
            <div class="expert-feature clearfix">
              <div class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/icon/3.png" alt=""></div>
              <div class="feature-caption">
              <span class="feature-title">
              医疗方向
              </span>
              <span style="height:180px;display:inline-block;border:2px solid #017f4f;padding:16px;border-radius:3px;">专案医生将根据您的需要提供帮助，协助您和家人了解整个治疗过程并将预后以及可能发生的结果做预估。在您的问题得到充分解答后，您的案例将视为结束。</span>
              </div>
            </div>
            
          </div>
        </div> -->
        <div class="expert-sub expert-sub-2">
          <h3><span>部分国际权威专科专家示例</span></h3>
          <div class="expert-main-example">
            <div class="image-wrapper">
              <img src="<?php echo $static_path; ?>/advance/img/expert-opinion01.jpg" alt="">
            </div>
            <div class="expert-info-wrapper">
              <span class="expert-remark expert-remark-1">&ldquo;当您对您的诊断、预后或可选的治疗方案范围有所顾虑的时候 - 那就是需要更多信息的时候了。专家医疗意见将针对能影响您治疗护理的医疗信息进行各项审查及衡量。&rdquo;</span>
              <span class="expert-info">哈佛医学院</span>
              <span class="expert-info">Theodore Steinman</span>
              <span class="expert-info">医学博士</span>
              <span class="expert-info">临床医学教授</span>
            </div>
          </div>
        </div>
        <div class="expert-example-wrapper clearfix">
          <div class="expert special-expert">
            <div class="image-wrapper">
              <img src="<?php echo $static_path; ?>/advance/img/portrait/potrait01.png" alt="">
            </div>
            <span>哈佛医学院</span>
            <div class="expert-details">
              <span class="expert-margin">
              </span>
              <span class="expert-name">Theodore Steinman</span>
              <span class="expert-info"><span>医学博士</span>
              <span> 临床医学教授</span>
             
            </div>
          </div>   
          <div class="expert">
            <div class="image-wrapper">
              <img src="<?php echo $static_path; ?>/advance/img/portrait/potrait02.png" alt="">
            </div>
            <span class="special-expert-name">Monica Castiglione‐Gertsch医生博士</span>
            <div class="expert-details">
              <span class="expert-margin">
              </span>
              <span class="expert-name">日内瓦大学医院</span>
              <span class="expert-info">妇科和乳腺肿瘤中心主任</span>
              <span class="text-center">瑞士苏黎世顾问</span>
            </div>
          </div>
          <div class="expert">
            <div class="image-wrapper">
              <img src="<?php echo $static_path; ?>/advance/img/portrait/potrait03.png" alt="">
            </div>
            <span>FRANCO M. MUGGIA医学博士</span>
            <div class="expert-details">
              <span class="expert-margin">
              </span>
              <span class="expert-name">纽约大学</span>
              <span class="expert-info">纽约大学医学院和Perimutter癌症研究所</span>
              <span class="text-center">医学肿瘤学教授，乳腺癌项目</span>
            </div>
          </div>
          <div class="expert">
            <div class="image-wrapper">
              <img src="<?php echo $static_path; ?>/advance/img/portrait/potrait04.png" alt="">
            </div>
            <span>DONALD I. ABRAMS医学博士</span>
            <div class="expert-details">
              <span class="expert-margin">
              </span>
              <span class="expert-name">加州大学</span>
              <span class="expert-info">加州大学，旧金山奥舍综合医学中心</span><!-- <span>旧金山总医院主任</span> --><span class="text-center">血液科/肿瘤科</span>
            </div>
          </div>
          <div class="expert expert-next">
            <div class="image-wrapper">
              <img src="<?php echo $static_path; ?>/advance/img/portrait/potrait05.png" alt="">
            </div>
            <span>ELLIOT S. KRAMES医学博士</span>
            <div class="expert-details">
            <span class="expert-margin">
              </span>
              <span class="expert-name">国际神经医学协会名誉主任</span>
              <span class="expert-info"><span>学习期刊:“神经调节”的荣誉编辑</span><!-- <span>学会期刊:《神经调控》名誉主编</span> --></span>
            </div>
          </div>
        </div>
       <!--  <div class="expert-example-caption">
          <span>我们的全球医疗团队包括10,000多名国际权威专科专家</span>
          <span>选择与您病症相关领域的权威医生是我们专家匹配的首要原则</span>
        </div> -->
      <!--   <div class="expert-summary clearfix">
          <div class="expert-satisfication">
            <div class="expert-satis-1"><span class="expert-satis-text">满意率</span><span>98</span>&percnt;</div>
            <div class="expert-satis-2">Patient satisfaction</div>
            <div class="expert-satis-3">创新服务&nbsp;卓越品质</div>
          </div>
          <div class="expert-circle">
            <img src="<?php echo $static_path; ?>/advance/img/circle.png" alt="">
            <div class="expert-circle-caption expert-circle-caption1">
              <h4>专业团队</h4>
              <p>业界唯一全部使用执照医生为患者引导完成个案的服务。资深的国际权威专家团队资源</p>
            </div>
            <div class="expert-circle-caption expert-circle-caption2">
              <h4>计划价值</h4>
              <p>权威专家严谨审阅病历报告之后，提出客观意见，并且书面回复病人的特定问题。高度私密、个性化的服务。避免不必要的诊疗护理花费，确保得到最优质的医疗关爱</p>
            </div>
            <div class="expert-circle-caption expert-circle-caption3">
              <h4>用户体验</h4>
              <p>与私人健康顾问无压力地顺畅沟通。经过咨询，获得关键信息，对自身病况及医疗建议十分明了</p>
            </div>
          </div>
        </div> -->
      </div>
      <div class="expert-section expert-section-2">
        <!-- <h2 id="foreign"><span class="title">海外治疗</span></h2>
        <div class="expert-sub expert-sub-3">
          <h3><span>海外诊疗计划</span></h3>
          <div class="expert-feature-wrapper2 clearfix">
            <div class="expert-feature2">
              <div class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/icon/1.png" alt=""></div>
              <div class="feature-caption">
                <span>匹配顶级</span><span>专科专家</span>
              </div>
            </div>
            <div class="expert-feature2">
              <div class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/icon/5.png" alt=""></div>
              <div class="feature-caption">
                <span>预约及安排</span><span>诊疗计划</span>
              </div>
            </div>
            <div class="expert-feature2">
              <div class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/icon/6.png" alt=""></div>
              <div class="feature-caption">
                <span>预估、优化</span><span>诊疗成本</span>
              </div>
            </div>
            <div class="expert-feature2">
              <div class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/icon/7.png" alt=""></div>
              <div class="feature-caption">
                <span>专案医生</span><span>定期跟进</span>
              </div>
            </div>
          </div>
        </div>
        <div class="expert-big-image">
          <img src="<?php echo $static_path; ?>/advance/img/expert-opinion02.jpg" alt="">
        </div>
        <div class="expert-sub expert-sub-4">
          <h3><span>海外诊疗计划安排</span></h3>
          <div class="diagnose-example-wrapper clearfix">   
          <div class="diagnose">
            <div class="image-wrapper">
              <img src="<?php echo $static_path; ?>/advance/img/arrange01.png" alt="">
            </div>
            <div class="diagnose-details">
              <span class="diagnose-margin">
              </span>
              <span>病人个案建立，</span>
              <span>私人健康顾问全程跟踪，</span>
              <span>
                收集医疗记录数据
              </span>
            </div>
          </div>
          <div class="diagnose">
            <div class="image-wrapper">
              <img src="<?php echo $static_path; ?>/advance/img/arrange02.png" alt="">
            </div>
            <div class="diagnose-details">
              <span class="diagnose-margin">
              </span>
              <span>全球匹配适合专家，</span>
              <span>并根据客观需要和病人意见</span>
              <span>
                锁定诊疗专家
              </span>
            </div>
          </div>
          <div class="diagnose">
            <div class="image-wrapper">
              <img src="<?php echo $static_path; ?>/advance/img/arrange03.png" alt="">
            </div>
            <div class="diagnose-details">
              <span class="diagnose-margin">
              </span>
              <span>安排与世界一流</span>
              <span>诊疗专家约见，给出</span>
              <span>
                最优惠的治疗解决方案
              </span>
            </div>
          </div>
          <div class="diagnose">
            <div class="image-wrapper">
              <img src="<?php echo $static_path; ?>/advance/img/arrange04.png" alt="">
            </div>
            <div class="diagnose-details">
              <span class="diagnose-margin">
              </span>
              <span>最终确认、</span>
              <span>安排治疗、后期跟进</span>
            </div>
          </div>
        </div>
        </div>
        <div class="diagnose-process-wrapper">
          <div class="diagnose-step diagnose-step-1 m-diagnose-step">
            <div class="diagnose-step-inner-wrapper1">
              <div class="diagnose-num m-num m-num1">1</div>
              <div class="diagnose-step-text">
                专案医生与病人联络收集病历病史及相关检查资料，并且撰写病案报告。
              </div>
            </div>
          </div>
          <div class="diagnose-step2 diagnose-step-2 m-diagnose-step2">
            <div class="diagnose-step-inner-wrapper2">
            <div class="diagnose-num diagnose-num2 m-num m-num2">2</div>
            <div class="diagnose-step-text">
              全球的医学委员会根据病案报告在全球匹配顶尖的专家，并且获得他们的日程安排。
            </div>
            </div>
          </div>
          <div class="diagnose-step diagnose-step-3 m-diagnose-step2">
            <div class="diagnose-step-inner-wrapper1">
            <div class="diagnose-num m-num m-num3">3</div>
            <div class="diagnose-step-text">
              专家医生与病人联络，协调安排就诊预约。
            </div>
            </div>
          </div>
          <div class="diagnose-step2 diagnose-step-4 m-diagnose-step">
            <div class="diagnose-step-inner-wrapper2">
            <div class="diagnose-num diagnose-num2 m-num m-num4">4</div>
            <div class="diagnose-step-text">
              相关专科专家出具治疗方案意见以及治疗费用建议。
            </div>
            </div>
          </div>
          <div class="diagnose-step diagnose-step-5 m-diagnose-step">
            <div class="diagnose-step-inner-wrapper1">
            <div class="diagnose-num m-num m-num1">5</div>
            <div class="diagnose-step-text">
              专案医生将方案的信息与病人做详尽讲解和沟通，取得病人书面确认。
            </div>
            </div>
          </div>
          <div class="diagnose-step2 diagnose-step-6 m-diagnose-step2">
            <div class="diagnose-step-inner-wrapper2">
            <div class="diagnose-num diagnose-num2 m-num m-num2">6</div>
            <div class="diagnose-step-text">
              病人支付定金。
            </div>
            </div>
          </div>
          <div class="diagnose-step diagnose-step-7 m-diagnose-step2">
            <div class="diagnose-step-inner-wrapper1">
            <div class="diagnose-num m-num m-num3">7</div>
            <div class="diagnose-step-text">
              汇医将与相关的医疗服务机构协商，优化整体治疗的费用。
            </div>
            </div>
          </div>
          <div class="diagnose-step2 diagnose-step-8 m-diagnose-step">
            <div class="diagnose-step-inner-wrapper2">
            <div class="diagnose-num diagnose-num2 m-num m-num4">8</div>
            <div class="diagnose-step-text">
              确保治疗开始，专案管理医生监督诊疗的执行，并随时提供专家审阅和负责其他转诊。医疗记录将以私人密件形式加以收录归档，以供专业医疗审计与专案管理报告的撰写。
            </div>
            </div>
          </div>
        </div>
        <div class="expert-sub expert-sub-5">
          <h3><span>疗程之后</span></h3>
        </div> -->
        <div class="diagnose-process-wrapper2 clearfix">
          <div class="diagnose-step">
            <div class="step-wrapper">
              <div class="diagnose-step-num">1</div>
              <div class="diagnose-step-context">
                <div class="diagnose-step-text">
                  <span class="step-title">全球医学专家意见服务适用场景</span>
                  
                  <ul>
                    <li>对于已有的疾病诊断有疑虑，需要专家确认 （例如癌症，心血管疾病）</li>
                    <li>对于病症在不同的医院得到不同的诊断</li>
                    <li>想了解对于目前治疗方案的其他选项分析</li>
                    <li>做重大医疗决策的时候，例如手术</li>
                    <li>注：以上场景适用于服务日生效后的新发疾病。</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="diagnose-step">
            <div class="step-wrapper step-wrapper2">
              <div class="diagnose-step-num diagnose-step-num2">10</div>
              <div class="diagnose-step-context">
                <div class="diagnose-step-text">
                  <span class="step-title">付款：</span>
                  <span class="step-text">
                  病人将治疗费用支付给相关医疗机构。
                  </span>
                </div>
              </div>
            </div>
          </div> -->
          <div class="diagnose-step">
            <div class="step-wrapper">
              <div class="diagnose-step-num">2</div>
              <div class="diagnose-step-context">
                <div class="diagnose-step-text">
                  <span class="step-title">全球医学专家意见服务不适用场景</span>
                  
                  <!-- <span class="step-text">
                  病人接受治疗后一周内，汇医将致电联系，了解病人的反馈以及回答问题，如有必要会做进一步调查。
                  </span> -->
                  <ul>
                    <li>需要紧急处理的病症，包括意外受伤和疾病的急性发作期，例如心肌梗塞、脑卒中等</li>
                    <li> 生命体征不稳定时，例如在ICU病房看护期间</li>
                    <li>日常健康类咨询，如普通感冒、发热、头痛</li>
                    <li>资料和信息不完整时，例如没有初次诊断、单一验血验尿报告等，具体由专案医生判定</li>
                    <li>病人或保险公司与医疗机构发生潜在纠纷时</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php endif; ?>




  <div class="app-mask">
  </div>
  <div class="bottom-nav-wrapper clearfix">
      <ul class="bottom-nav">
        
        <li ><a href="https://www.allianz.com.cn">关于中德安联</a></li>  <!-- <?php echo url('/Allianz/EMO/services/1'); ?>#Gemomao -->
        <li ><a href="http://advance-medical.net/about">关于汇医</a></li>
        <!-- <li><a href="<?php echo url('/services/2'); ?>#pressure" class="special-text">专属心理和职业教练疏导</a></li>
        <li><a href="<?php echo url('/services/3'); ?>#statistics">体检数据解读</a></li>
        <li><a href="<?php echo url('/services/3'); ?>#subhealth" class="special-text">亚健康/慢病管理</a></li>
        <li><a href="<?php echo url('/services/4'); ?>#resource" class="special-text">医生推荐和医疗机构导航</a></li> -->
      </ul>
    </div>
    <div class="medical-footer">
      <div class="medical-footer-text" style="font-size:12px"><!-- 汇医健康顾问门户网站所提供的服务旨在向用户提供医疗咨询。在任何情况下，这些咨询服务仅应被视为医疗咨询的建议。而这些医疗咨询的建议是根据客户提供的医疗信息所做出的，并不能取代专业医疗机构的医疗诊断。 -->汇医提供的独立医疗意见服务将不涉及任何形式的医学诊断，治疗以及开具处方。</div>
    </div>
    <!--弹出-->
  <div class="mobile-form-outter-wrapper">
    <div class="mobile-form-wrapper">
      <div class="mobile-form-home-header">
          <div class="mobile-home-header-text">选择咨询类别</div>
          <span class="mobile-close-button"><span>&#10006;</span></span>
      </div>
      <div class="m-form-choice-wrapper">
        
        <?php if(is_array($service_list) || $service_list instanceof \think\Collection || $service_list instanceof \think\Paginator): $i = 0; $__LIST__ = $service_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sl): $mod = ($i % 2 );++$i;?>
                <a type="button" class="btn m-btn-medical <?php echo $sl['mobile_style']; ?>" href="<?php echo url('/mobile_form/'.$sl['id']); ?><?php echo $sl['m_id_name']; ?>"><?php echo $sl['typename']; ?></a>
        <?php endforeach; endif; else: echo "" ;endif; ?>

      </div>
    </div>
  </div>
    <!--登录-->
  <div class="form-outter-wrapper">
    <div class="form-diagnose">
      <div class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/diagnose.png" alt=""></div>
      <div class="form-diagnose-text">一键咨询</div>
    </div>
    <div class="form-inner-wrapper">
      <div class="form-home-header">
        <div class="home-header-text">请先选择您的问诊类别<span class="image-wrapper"><img src="<?php echo $static_path; ?>/advance/img/form-arrow.png" alt=""></span></div>
        <span class="close-button"><span>&#10006;</span></span>
      </div>
      <div class="form-choice-wrapper">
          <?php if(is_array($service_list) || $service_list instanceof \think\Collection || $service_list instanceof \think\Paginator): $i = 0; $__LIST__ = $service_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sl): $mod = ($i % 2 );++$i;?>
           <button type="button" class="btn btn-medical <?php echo $sl['pc_style']; ?>"><?php echo $sl['typename']; ?></button>
          <?php endforeach; endif; else: echo "" ;endif; ?>

      </div>
      <div class="form-wrapper">
        <div class="form-feedback-wrapper">
          <div class="form-feedback">
            <p><!-- 递交成功，我们将会尽快联系您。 -->感谢！我们将尽快与您联系。</p>
            <button class="btn form-feedback-btn">我知道了</button>
          </div>
        </div>
        <div class="medical-form-header">
          <div class="close-button form-close-button"><span>&#10006;</span></div>
          <div class="form-step-indicator clearfix"><!--
              --><div><span>患者信息</span></div><!--
              --><div><span>申请人信息</span></div><!--
              --><div><span>病情描述</span></div><!--
          --></div>
        </div>
          <form autocomplete="off" class="medical-form form-horizontal" role="form" method="post" >
          <input type="hidden" id="form-type" name="case_type" value="">
          <div class="form-section">
            <div class="form-group">
              <label for="patient-name" class="col-xs-4 col-sm-3 control-label medical-label">患者姓名</label>
              <div class="col-xs-8 col-sm-9">
                <input type="text" class="form-control" id="patient-name" name="username">
              </div>
            </div>
            <div class="form-group date-select">
              <label for="birth-date" class="col-xs-4 col-sm-3 control-label medical-label">出生日期</label>
              <div class="col-xs-8 col-sm-9">
                <input type="text" class="form-control" id="patient-birth" name="birthday" data-field="date" readonly="">
                <div class="box-container"><div id="dtBox"></div></div>
              </div>
            </div>
            <div class="form-group">
              <label for="patient-gender" class="col-xs-4 col-sm-3 control-label medical-label">性别</label>
              <div class="col-xs-8 col-sm-9">
                <div class="col-xs-6 col-sm-4 gender-single">
                  <label for="patient-gender1"><input type="radio" name="sex" id="patient-gender1" value="1"><span>男性</span></label>
                </div>
                <div class="col-xs-6 col-sm-4 gender-single">
                  <label for="patient-gender2"><input type="radio" name="sex" id="patient-gender2" value="0"><span>女性</span></label>
                </div>
                <div class="col-xs-12 gender-error"></div>
              </div>
            </div>
          </div>
          <div class="form-section">
           <div class="form-group">
              <label for="" class="col-xs-6 col-sm-4 control-label medical-label">是否为患者本人</label>
              <div class="col-xs-6 col-sm-8 relation-between">
                <div class="col-xs-6 col-sm-6 relation-single">
                  <label for="is-patient-self1"><input type="radio" name="isme" id="is-patient-self1" value="1" checked><span>是</span></label>
                </div>
                <div class="col-xs-6 col-sm-6 relation-single">
                  <label for="is-patient-self2"><input type="radio" name="isme" id="is-patient-self2" value="0"><span>否</span></label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="other-relation" class="col-xs-5 col-sm-4 control-label medical-label">与患者关系</label>
              <div class="col-xs-7 col-sm-8">
                <select id="other-relation" disabled="" name="relationship" class="not-mandatory">
                  <option value=""></option>
                  <option value="父母">父母</option>
                  <option value="子女">子女</option>
                  <option value="配偶">配偶</option>
                  <option value="其他">其他</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="applicant-name" class="col-xs-5 col-sm-4 control-label medical-label">申请人姓名</label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control" id="applicant-name" name="applicant_name">
              </div>
            </div>
              <div class="form-group">
              <label for="country" class="col-xs-5 col-sm-4 control-label medical-label">国家</label>
              <div class="col-xs-7 col-sm-8">
                <select id="country" name="country" >
                  <?php if(is_array($country_list) || $country_list instanceof \think\Collection || $country_list instanceof \think\Paginator): $i = 0; $__LIST__ = $country_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cl): $mod = ($i % 2 );++$i;?>
                    <option  value="<?php echo $cl['value']; ?>" ><?php echo $cl['name']; ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
            </div>
              <div class="form-group">
              <label for="country" class="col-xs-5 col-sm-4 control-label medical-label">省(州)</label>
              <div class="col-xs-7 col-sm-8">
                  <input type="text" class="form-control" id="e_province" name="e_province">
              </div>
            </div>
            <div class="form-group">
              <label for="user-address" class="col-xs-5 col-sm-4 control-label medical-label"><span class="has-width">居住地址</span></label>
              <div class="col-xs-7 col-sm-8">
                <div class="col-xs-4 col-sm-4 address-choose">
                  <select id="province" name="province">
                      <option value="0">省</option>
                       <?php if(is_array($area) || $area instanceof \think\Collection || $area instanceof \think\Paginator): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                         <option  value="<?php echo $vo['id']; ?>" ><?php echo $vo['area_name']; ?></option>
                         <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div>
                <div class="col-xs-4 col-sm-4 address-choose">
                  <select id="city" name="city">
                      <option value="0">市</option>
                  
                  </select>
                </div>
                <div class="col-xs-4 col-sm-4 address-choose">
                  <select id="district" name="district">
                      <option value="0">区</option>
                  
                  </select>
                </div>
                <div class="col-xs-12 col-sm-12 address-details">
                  <input type="text" class="form-control" id="address-details" name="address" placeholder="常住家庭地址">
                </div>
              </div>
            </div>
            <div class="form-group" >
              <label for="user-zip" class="col-xs-5 col-sm-4 control-label medical-label"><span class="has-width">邮编</span></label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control" id="zip_code" name="zip_code">
              </div>
            </div>
            <div class="form-group">
              <label for="user-first-phone" class="col-xs-5 col-sm-4 control-label medical-label"><span class="has-width">常用手机联系方式</span></label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control" id="user-first-phone" name="preferred_phone">
              </div>
            </div>
            <div class="form-group">
              <label for="user-second-phone" class="col-xs-5 col-sm-4 control-label medical-label"><span class="has-width">备用手机联系方式</span></label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control" id="user-second-phone" name="standby_phone">
              </div>
            </div>
            <div class="form-group">
              <label for="user-email" class="col-xs-5 col-sm-4 control-label medical-label"><span class="has-width"><span class="little-character">电子邮箱</span></label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control" id="user-email" name="email">
              </div>
            </div>
            <div class="form-group">
              <label for="user-time" class="col-xs-5 col-sm-4 col-md-4 col-lg-4 control-label medical-label special-label"><div class="time-grid"><span style="width:6em;"><!-- 接听电话</span><span>优选时间 -->方便通话时间</span></div><!-- <div>&#40;可多选&#41;</div> --></label>
              <div class="col-sm-8 col-md-8 col-lg-8 user-time">
                <div class="user-time-wrapper">
                  <div class="time-wrapper"><div class="time-inner-wrapper"><label><input type="checkbox" name="preferred_time" value="9am-12pm"><span>9am-12pm</span></label></div><div class="time-inner-wrapper"><label><input type="checkbox" name="preferred_time" value="12pm-3pm"><span>12pm-3pm</span></label></div></div>
                  <div class="time-wrapper"><div class="time-inner-wrapper"><label><input type="checkbox" name="preferred_time" value="3pm-6pm"><span>3pm-6pm</span></label></div><div class="time-inner-wrapper"><label><input type="checkbox" name="preferred_time" value="6pm-9pm"><span>6pm-9pm</span></label></div></div>
                </div>
                <div class="user-time-error"></div>
              </div>
            </div>
          </div>
          <div class="form-section">
            <div class="form-group">
              <label class="col-xs-12 col-sm-12 control-label medical-label change-label">请简述您的诊断和主要需求</label>
            </div>
            <div class="form-group">
              <div class="col-xs-12 col-sm-12">
                <textarea class="info-details" name="illness"></textarea>
              </div>
            </div>
            <a href="javascript:;" class="a-upload">
                <input type="file" name="upload_file" id="upload_file">上传我的病史资料(可选)
            </a><span id="upload_result"></span>
            <p>文件仅支持单个JPG,PDF,JPEG,PNG,DOC,ZIP格式,多个文件请压缩ZIP上传,最大上传大小为10M</p>
            <div class="form-group optional-checkbox">
              <div class="col-sm-12">
                <input type="checkbox" id="doctor-checkbox" name="doctor_checkbox">
                <label for="doctor-checkbox">现有医疗团队的信息（可选）</label>
              </div>
            </div>
            <div class="form-group doctor-group">
              <label for="doctor-name" class="col-xs-5 col-sm-4 control-label medical-label">主治医生姓名</label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control doctor-name doctor"  name="treatment_doctor">
              </div>
            </div>
            <div class="form-group doctor-group">
              <label for="doctor-hospital" class="col-xs-5 col-sm-4 control-label medical-label">医院名称</label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control doctor-hospital doctor"  name="treatment_hospital">
              </div>
            </div>
            <div class="form-group doctor-group">
              <label for="doctor-major" class="col-xs-5 col-sm-4 control-label medical-label">科室</label>
              <div class="col-xs-7 col-sm-8">
                <input type="text" class="form-control doctor-major doctor"  name="specialty">
              </div>
            </div>
          </div>
          <div class="checkbox-wrapper">
            <div class="form-group">
              <div class="col-sm-12">
                <input type="checkbox" id="contract-checkbox" name="contract-checkbox" checked="">
                <label for="contract-checkbox">我已经阅读并接受了条款和条件</label><span class="contract-click">授权协议</span>
              </div>
            </div>
          </div>
          <div class="contract-check-error"></div>
          <div class="form-navigation clearfix">
            <button type="button" class="back-to-home btn btn-navigate pull-left">返回</button>
            <button type="button" class="previous btn btn-navigate pull-left">上一步</button>
            <button type="button" class="next btn btn-navigate pull-right">下一步</button>
            <input type="submit" value="提交" class="btn btn-navigate pull-right submit-btn">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="contract-context">
    <div class="contract-header">
      <span>授权协议</span><span class="contract-close-button"><i class="fa fa-times"></i></span>
    </div>
    <div class="contract-para" id="contract-para">
      <div class="para-outter-wrapper"><p><!-- 在开始医疗专家意见书服务之前，您必须阅读，理解并同意以下条款和条件。 -->
     以上提供的信息均为真实。我理解专家意见服务的内容并接受以下陈述:</p></div>
      <div class="para-outter-wrapper"><span>1、</span><p><!-- 您在此授权您的治疗医师和其他医疗服务提供者将所有相关的个人和医疗数据披露给高级医疗公司，用于获得第二个意见，并授予高级医疗公司，许可其按在我们的隐私声明中所描述方式使用和披露这一信息。如果需要，您将为每个医师或其他医疗服务提供者签署单独的授权表，允许他们与我们分享保护的健康信息。您同意，您提供给我们的信息尽您所知将是准确和完整的。您有责任确保所有相关资料已提供给高级医疗公司。 --> 本申请表中提供给中德安联 (包括电话方式)的所有个人和医疗数据等“个人隐私信息”,仅被用于此保险产品涵盖的健康顾问和医疗专家意见服务,在必要时与相关与医疗专家和医疗机构分享。</p></div>
      <div class="para-outter-wrapper"><span>2、</span><p><!-- 该报告是关于您的案件的医疗专家的意见，这基于您提供给我们的，以及我们经您许可，从您的医生获得的医疗信息。润色医疗专家意见报告的医生，不会获得亲自为您检查，订购额外的测试，或者获取超出您所提供的信息之外的任何信息的利益。由于医学专家将没有亲自检查您，或订购额外的测试，它不属于医疗诊断。通过医疗专家意见书项目的医学专家，不会并不能仅基于我们收到的信息，为您的医疗负责。医疗决策应在亲自检查和诊断测试之后做出，如您的检查和病史所示。该报告旨在为您提供信息来补充您已经从您的治疗医生那里获得的信息。医疗专家意见报告中包含的信息不得用于替代您的医生的建议。您应该与自己的、负责您的医疗的医生讨论此报告。 -->我们会妥善安全地使用您的资料。您的数据在咨询相关专家是将被匿名,以保护您的隐私。</p></div>
      <div class="para-outter-wrapper"><span>3、</span><p><!-- 您确认，您的健康保险可能不包括建议在医疗专家意见报告中推荐的特定测试或治疗，因为涵盖范围取决于您的健康保险条款。高级医疗公司和医疗专家不会为您的健康保险决定健康福利涵盖范围的决定。请参考您的保险公司，以核实涵盖范围和预授权处理。 -->您在此接受中德安联及其合作伙伴的员工与您联系,以获得必要的信息为您提供服务。</p></div>
      <div class="para-outter-wrapper"><span>4、</span><p><!-- 为了给您进行服务，高级医疗公司将从您和您的医疗服务提供者收集您的医疗信息，并转交给我们在美国的办公室，或其他的高级医疗公司办公室。可应要求提供涉及您的案件中涉及的个人和国家的详细信息。 -->您在此同意根据服务要求提供所有相关的准确、完整的个人和医疗数据,以推进健康顾问和医疗意见流程。</p></div>
      <div class="para-outter-wrapper"><span>5、</span><p><!-- 如果申请人不是病人或病人的代表，我们需要患者的书面授权，才能披露其任何医疗或个人识别数据。 -->您在此同意中德安联因基于本服务的需要而向专案医生提供您已提交给中德安联的医疗信息资料（如有），并分享您的专家医疗意见报告。 </p></div>
      <div class="para-outter-wrapper"><span>6、</span><p><!-- 本人保证上述信息尽我所知是准确的。我已阅读并理解了上述信息，并同意这些条款。 -->给您出具专家医疗意见报告的医生将不会从您做医疗检查中获取利益。给您提供的是健康顾问和医疗意见服务，不涉及直接诊断及治 疗。顾问和意见报告服务旨在为您提供补充信息，不可用来代替您医生的建议。
      </p></div>
      <div class="para-outter-wrapper"><span>7、</span><p><!-- 我保证医疗专家意见书的参与者是公司的员工，或其合格的配偶，或公司的员工的家庭伴侣，或公司员工的有资格的、受抚养的子女。 -->接收到顾问和意见报告之后，由您做出相关的决策和选择。安联及其合作伙伴不对您做任何倾向性的推荐，不对您的主观意志和决 定及其后果负责。</p></div>
    </div>
  </div>

   
    
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/jquery-1.12.0.min.js?_=<?php echo $site_version; ?>"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/jquery.validate.min.js?_=<?php echo $site_version; ?>"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/jquery.flexslider.js?_=<?php echo $site_version; ?>"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/jquery.city.select.min.js?_=<?php echo $site_version; ?>"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/perfect-scrollbar.min.js?_=<?php echo $site_version; ?>"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/perfect-scrollbar.jquery.min.js?_=<?php echo $site_version; ?>"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/DateTimePicker.min.js?_=<?php echo $site_version; ?>"></script>
  <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/DateTimePicker-ltie9.min.js"></script>
  <![endif]-->
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/vendor/DatetimePicker-i18n-zh-CN.js?_=<?php echo $site_version; ?>"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/main.js?_=<?php echo $site_version; ?>"></script>
  <script type="text/javascript" src="<?php echo $static_path; ?>/advance/js/forms.js?_=<?php echo $site_version; ?>"></script>

 
  <script type="text/javascript">
      window.__addurl__='<?php echo url('Index/addCase'); ?>';
      window.__loginurl__='<?php echo url('Login/index'); ?>';
    $(function(){
        


               function isChina(){
             var country_val=$("select[name='country']").val();
             if(country_val!=1){
                 $("#province").hide();
                 $("#city").hide();
                 $("#district").hide();
                 $("#zip_code").parent().parent().hide();
                 $("#e_province").parent().parent().show();
             }else{
                 $("#province").show();
                 $("#city").show();
                 $("#district").show();
                 $("#zip_code").parent().parent().show();
                 $("#e_province").parent().parent().hide();
             }
         }
            

    isChina();

      $("select[name='country']").change(function(){
          
            isChina();
      });
  
      
      function getcity(id){
          		var current_province_id=id;
                  
		
		$.ajax({
			url:"<?php echo url('@module/cases/Interfaces/getCity'); ?>",
			data:{ParentId:current_province_id},
			dataType:'json',
			type:'post',
                        async: false,
			success:function(re){
				var html='<option value="0">请选择</option>';
                                $("[name='district']").html(html);
				var item=re.data;
				for(var i in item){
					html +='<option value="'+item[i]['id']+'" >'+item[i]['area_name']+'</option>';
				}
				$("[name='city']").html(html);
                                
			}
		})
      }
      
      
      function getdistrict(id){
          		var current_city=id;
		$.ajax({
			url:"<?php echo url('@module/cases/Interfaces/getDistrict'); ?>",
			data:{ParentId:current_city},
			dataType:'json',
			type:'post',
			success:function(re){
				var html='<option value="0">请选择</option>';
				var item=re.data;
				for(var i in item){
					html +='<option value="'+item[i]['id']+'" >'+item[i]['area_name']+'</option>';
				}
				$("[name='district']").html(html);
			}
		})
      }
      	$("[name='province']").change(function(){
		$("[name='city']").html('<option value="0">请选择</option>');
                getcity($(this).val());
                $("[name='district']").val();
	})
	$("[name='city']").change(function(){
		$("[name='district']").html('<option value="0">请选择</option>');

                getdistrict($(this).val());
	})
	var pro_id=$("[name='province']").val();
        if(pro_id>0){
            $("[name='city']").html('<option value="0">请选择</option>');
            getcity($("[name='province']").val());
            $("[name='district']").html('<option value="0">请选择</option>');
            getdistrict($("[name='province']").val());
        }


});
 $.each($('.logvilad'),function(i){
     $(this).click(function(){
         if(<?php echo $userid; ?>==0){
             window.location.href='<?php echo url('Login/index'); ?>';
         }
     })
     
 })

// 上传文件
	$('#upload_file').on('change', function(){
		
		var uploadFile = $(this).get(0).files[0];
		
		if(typeof uploadFile == 'undefined'){
			return false;
		}
		
		var formData = new FormData();
		
		formData.append('upload_file', uploadFile);
		var ajaxOption = {
			url 	: '<?php echo url("advance/Upload/upload"); ?>',
			type	: 'post',
			data	: formData,
			dataType: 'json',
			timeout	: 0,
			processData : false,
			contentType : false,
			success	: function(res){
				
				if(res.code == 1){
					$('#upload_result').html('<span >['+res.data.hash+'.'+res.data.ext+']</span>');
				       $('#upload_file').before('<input type="hidden" value="'+res.data.url+'" name="options"/>');
				}else{
					$('#upload_result').html('<span >['+res.msg+']</span>');
				}
			},
			error : function(xhr){
				
				$('#upload_result').html('<span >[网络链接错误]</span>');
			}
		};
		$.ajax(ajaxOption);
	});
</script>
  
</body>
</html>


