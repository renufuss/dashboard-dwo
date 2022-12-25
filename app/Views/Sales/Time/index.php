<?= $this->extend('Layout/index'); ?>


<?= $this->section('content'); ?>

<link href="<?= base_url(); ?>/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>/assets/plugins/custom/vis-timeline/vis-timeline.bundle.css" rel="stylesheet" type="text/css" />


<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Time</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="<?= base_url(); ?>" class="text-muted text-hover-primary">Sales</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Time</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Row-->
            <div class="row gx-5 gx-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-6 mb-5 mb-xl-10">
                    <!--begin::Chart widget 27-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header py-7">
                            <!--begin::Statistics-->
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Title-->
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2"><?= $showLineTotal; ?></span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Description-->
                                <span class="fs-6 fw-semibold text-gray-400">Line Total</span>
                                <!--end::Description-->
                            </div>
                            <!--end::Statistics-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-0 pb-1">
                            <div id="lineTotalDay" class="min-h-auto"></div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 27-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-6 mb-5 mb-xl-10">
                    <!--begin::List widget 9-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header py-7">
                            <!--begin::Statistics-->
                            <select class="form-select form-select-solid" style="cursor: pointer;" name="day" id="day" data-control="select2" data-hide-search="true" data-placeholder="Pilih Hari...">
                                <?php foreach ($showDay as $row) : ?>
                                    <option value="<?= $row->day; ?>"><?= $row->day; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!--end::Statistics-->
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body card-body d-flex justify-content-between flex-column pt-3">
                            <div class="daySalesProduct"></div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::List widget 9-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>


<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="<?= base_url(); ?>/assets/plugins/global/plugins.bundle.js"></script>
<script src="<?= base_url(); ?>/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used by this page)-->
<script src="<?= base_url(); ?>/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used by this page)-->
<script src="<?= base_url(); ?>/assets/js/widgets.bundle.js"></script>
<script src="<?= base_url(); ?>/assets/js/custom/widgets.js"></script>
<script src="<?= base_url(); ?>/assets/js/custom/apps/chat/chat.js"></script>
<script src="<?= base_url(); ?>/assets/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="<?= base_url(); ?>/assets/js/custom/utilities/modals/create-app.js"></script>
<script src="<?= base_url(); ?>/assets/js/custom/utilities/modals/users-search.js"></script>
<!--end::Custom Javascript-->


<script>
    var KTChartsWidget27 = function() {
        var e = {
                self: null,
                rendered: !1
            },
            t = function(e) {
                var t = document.getElementById("lineTotalDay");
                if (t) {
                    var a = KTUtil.getCssVariableValue("--kt-gray-800"),
                        l = KTUtil.getCssVariableValue("--kt-border-dashed-color"),
                        r = {
                            series: [{
                                name: "Line Total",
                                data: <?= $lineTotal; ?>
                            }],
                            chart: {
                                fontFamily: "inherit",
                                type: "bar",
                                height: 350,
                                toolbar: {
                                    show: !1
                                }
                            },
                            plotOptions: {
                                bar: {
                                    borderRadius: 8,
                                    horizontal: !0,
                                    distributed: !0,
                                    barHeight: 50,
                                    dataLabels: {
                                        position: "bottom"
                                    }
                                }
                            },
                            dataLabels: {
                                enabled: !0,
                                textAnchor: "start",
                                offsetX: 0,
                                formatter: function(e, t) {
                                    e *= 1;
                                    return wNumb({
                                        thousand: ","
                                    }).to(e)
                                },
                                style: {
                                    fontSize: "14px",
                                    fontWeight: "600",
                                    align: "left"
                                }
                            },
                            legend: {
                                show: !1
                            },
                            colors: ["#3E97FF", "#F1416C", "#50CD89", "#FFC700", "#7239EA"],
                            xaxis: {
                                categories: <?= $day; ?>,
                                labels: {
                                    formatter: function(e) {
                                        return e + ""
                                    },
                                    style: {
                                        colors: a,
                                        fontSize: "10px",
                                        fontWeight: "600",
                                        align: "left"
                                    }
                                },
                                axisBorder: {
                                    show: !1
                                }
                            },
                            yaxis: {
                                labels: {
                                    formatter: function(e, t) {
                                        return Number.isInteger(e) ? e + " - " + parseInt(100 * e / 18).toString() + "%" : e
                                    },
                                    style: {
                                        colors: a,
                                        fontSize: "14px",
                                        fontWeight: "600"
                                    },
                                    offsetY: 2,
                                    align: "left"
                                }
                            },
                            grid: {
                                borderColor: l,
                                xaxis: {
                                    lines: {
                                        show: !0
                                    }
                                },
                                yaxis: {
                                    lines: {
                                        show: !1
                                    }
                                },
                                strokeDashArray: 4
                            },
                            tooltip: {
                                style: {
                                    fontSize: "12px"
                                },
                                y: {
                                    formatter: function(e) {
                                        return e
                                    }
                                }
                            }
                        };
                    e.self = new ApexCharts(t, r), setTimeout((function() {
                        e.self.render(), e.rendered = !0
                    }), 200)
                }
            };
        return {
            init: function() {
                t(e), KTThemeMode.on("kt.thememode.change", (function() {
                    e.rendered && e.self.destroy(), t(e)
                }))
            }
        }
    }();

    $(document).ready(function() {
        daySalesProduct();
    });

    function daySalesProduct() {
        $.ajax({
            type: "post",
            url: "/sales/time/product",
            data: {
                day: $('#day').val(),
            },
            dataType: "json",
            beforeSend: function() {
                $(".daySalesProduct").html(`
                <svg class="pl" width="240" height="240" viewBox="0 0 240 240">
	                <circle class="pl__ring pl__ring--a" cx="120" cy="120" r="105" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 660" stroke-dashoffset="-330" stroke-linecap="round"></circle>
	                <circle class="pl__ring pl__ring--b" cx="120" cy="120" r="35" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 220" stroke-dashoffset="-110" stroke-linecap="round"></circle>
	                <circle class="pl__ring pl__ring--c" cx="85" cy="120" r="70" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round"></circle>
	                <circle class="pl__ring pl__ring--d" cx="155" cy="120" r="70" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round"></circle>
                </svg>
                `);
            },
            success: function(response) {
                $('.daySalesProduct').html(response.daySalesProduct);
            }
        });
    }
</script>


<!--end::Javascript-->
<?= $this->endSection(); ?>