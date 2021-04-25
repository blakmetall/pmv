<section id="block-quick-search-quick-search-block" class="block block-quick-search clearfix">
    <form action="{{ route('public.availability-results') }}" id="quick-search-form" accept-charset="UTF-8">
        <div>
            <div class="row-fluid">
                <div class="col-xs-10">
                    <div class="form-item form-item-sk form-type-textfield form-group">
                        <input placeholder="{{ __('Quick search') }}" class="form-control form-text" type="text" id="edit-sk"
                            name="property_name" value="" size="60" maxlength="128" />
                    </div>
                </div>
                <div class="form-actions form-wrapper form-group" id="edit-actions">
                    <div>
                        <button title="{{ __('Search') }}" class="btn btn-success btn-loading form-submit"
                            data-loading-text="&lt;i class=&quot;fa fa-spinner fa-spin&quot;&gt;&lt;/i&gt;"
                            type="submit" id="edit-submit"
                            value="&lt;span class=&quot;glyphicon glyphicon-search&quot;&gt;&lt;/span&gt;">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
