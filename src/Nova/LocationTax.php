<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Panel;
use Tipoff\Locations\Nova\Location;
use Tipoff\Support\Nova\BaseResource;
use Tipoff\Taxes\Enum\TaxCode;
use Tipoff\Taxes\Models\LocationTax as LocationTaxModel;

class LocationTax extends BaseResource
{
    public static $model = LocationTaxModel::class;

    public static $title = 'id';

    public static $search = [
        'id',
    ];

    public static $group = 'Operations Units';

    //public function fieldsForIndex(NovaRequest $request)
    //{
    //    return array_filter([
    //        ID::make()->sortable()
    //    ]);
    //}

    public function fields(Request $request)
    {
        return array_filter([
            ID::make()->sortable(),
            BelongsTo::make('Location', 'location', Location::class),
            Select::make('Tax Code')->options([
                TaxCode::BOOKING => 'Booking',
                TaxCode::PRODUCT => 'Product',
            ])->required(),

            BelongsTo::make('Tax', 'tax', Tax::class),

            new Panel('Data Fields', $this->dataFields()),
        ]);
    }

    protected function dataFields(): array
    {
        return array_filter([
            ID::make(),
            nova('user') ? BelongsTo::make('Created By', 'creator', nova('user'))->exceptOnForms() : null,
            nova('user') ? BelongsTo::make('Updated By', 'updater', nova('user'))->exceptOnForms() : null,
            DateTime::make('Created At')->exceptOnForms(),
            DateTime::make('Updated At')->exceptOnForms(),
        ]);
    }
}
