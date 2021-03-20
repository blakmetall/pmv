import { initDatepickerComponents } from "./initDatepickerComponents.js";
import { initFastSelectComponents } from "./initFastSelectComponents.js";
import { getBonus } from "./getBonus.js";

export function initCleaningServicesModalHandler() {
    var modals = $(".app-cleaning-service-modal");

    modals.each(function() {
        var id = $(this).attr("id");
        var modal = $("#" + id);
        var container = $(this).find(".app-cleaning-service-modal-container");
        var url = container.data("url");

        modal.on("show.bs.modal", function(e) {
            var propertyID = $(e.relatedTarget).data("property");
            var maidFee = $(e.relatedTarget).data("maid-fee");
            let loadFee = $(e.relatedTarget).data("load-fee");
            let propertyDate = $(e.relatedTarget).data("date");
            let date = new Date(propertyDate).getDay();
            $.get(url, function(html) {
                container
                    .html(html)
                    .promise()
                    .done(function() {
                        modal.modal("handleUpdate");
                        initDatepickerComponents();
                        initFastSelectComponents();
                        setTimeout(function() {
                            getBonus(propertyID, date);
                            $("#field_property_status_ids_").change(function() {
                                if ($.inArray("8", $(this).val()) != -1) {
                                    $("#field_cleaning-service_maid_fee_").val(
                                        0
                                    );
                                    $("#field_property_sunday_bonus_").val(0);
                                } else {
                                    $("#field_cleaning-service_maid_fee_").val(
                                        maidFee
                                    );
                                    getBonus(propertyID, date);
                                }
                                setTimeout(function() {
                                    $(".fstChoiceRemove").each(function() {
                                        $(this).on("click", function() {
                                            let text = $(this)
                                                .parent(".fstChoiceItem")
                                                .data("value");
                                            if (text === 8) {
                                                $(
                                                    "#field_cleaning-service_maid_fee_"
                                                ).val(maidFee);
                                                getBonus(propertyID, date);
                                            }
                                        });
                                    });
                                }, 500);
                            });

                            $(".fstChoiceRemove").each(function() {
                                $(this).on("click", function() {
                                    let text = $(this)
                                        .parent(".fstChoiceItem")
                                        .data("value");
                                    if (text === 8) {
                                        $(
                                            "#field_cleaning-service_maid_fee_"
                                        ).val(maidFee);
                                    }
                                });
                            });
                            $("#field_cleaning-service_property_id_").val(
                                propertyID
                            );
                            if (loadFee) {
                                $("#field_cleaning-service_maid_fee_").val(
                                    maidFee
                                );
                            }
                            if (maidFee == "0.00" || maidFee == "") {
                                $(".maid_fee").hide();
                            } else {
                                $(".maid_fee").show();
                            }
                            $("#maid_fee_base span").html(maidFee);
                            $("#field_cleaning-service_date_").val(
                                propertyDate
                            );
                        }, 500);

                        $('#form-cleaning-service').submit( function(e){
                            let errorFields = '#error-fields';
                            let inputDate = $(this).find('input[name="date"]');
                            let textareaDescription = $(this).find('textarea[name="description"]');
                            let inputMaidFee = $(this).find('input[name="maid_fee"]');
                            let inputSundayBonus = $(this).find('input[name="sunday_bonus"]');
                            if(
                                !$(inputDate).val() || 
                                !$(textareaDescription).val() ||
                                !$(inputMaidFee).val() ||
                                !$(inputSundayBonus).val()){
                                $(errorFields).show();
                                setTimeout(function(){
                                    $(errorFields).hide();
                                }, 5000);
                                return false;
                            }else{
                                $(errorFields).hide();
                            }
                        });
                    });
            });
        });
    });
}
