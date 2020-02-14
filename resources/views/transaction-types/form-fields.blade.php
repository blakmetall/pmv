
    <div class="form-group row">
        <label for="inputNameEs" class="col-sm-2 col-form-label">{{ __('Transaction Type Es') }}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputNameEs" name="inputNameEs" placeholder="{{ __('Transaction Type Es') }}">
            @if ($errors->has('inputNameEs'))
                <div class="" role="alert" style="color: red; padding: 5px 0px;">
                    {{ $errors->first('inputNameEs') }}
                </div>
            @endif
        </div>

    </div>

    <div class="form-group row" >
        <label for="inputNameEn" class="col-sm-2 col-form-label">{{ __('Transaction Type En') }}</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputNameEn" name="inputNameEn" placeholder="{{ __('Transaction Type En') }}">
            @if ($errors->has('inputNameEs'))
                <div class="" role="alert" style="color: red; padding: 5px 0px;">
                    {{ $errors->first('inputNameEs') }}
                </div>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Sign in</button>

        </div>
    </div>
</form>