<?php

namespace Tipoff\Taxes\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Support\Nova\BaseResource;
use Tipoff\Taxes\Models\Tax as TaxModel;

class Tax extends BaseResource
{
    public static $model = TaxModel::class;

    public static $title = 'name';

    public static $search = [
        'id',
        'name',
        'title',
    ];

    public static $group = 'Operations Units';

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),
            Number::make('Percent'),
            Text::make('Name')->sortable(),
            Text::make('Applies To')->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('Name')->required(),
            Slug::make('Slug')->from('Name'),
            Number::make('Percent'),
            Text::make('Title'),
            Select::make('Applies To')->options([
                TaxModel::APPLIES_TO_BOOKING => 'Booking',
                TaxModel::APPLIES_TO_PRODUCT => 'Product',
            ])->required(),

            new Panel('Data Fields', $this->dataFields()),

            nova('booking') ? HasMany::make('Bookings', 'bookings', nova('booking')) : null,
            nova('location') ? HasMany::make('Location Booking Tax', 'locationBookingTaxes', nova('location')) : null,
            nova('location') ? HasMany::make('Location Product Tax', 'locationProductTaxes', nova('location')) : null,

        ]);
    }

    protected function dataFields(): array
    {
        return array_filter([
            ID::make(),
            nova('user') ? BelongsTo::make('Created By', 'creator', nova('user'))->exceptOnForms() : null,
            DateTime::make('Created At')->exceptOnForms(),
            DateTime::make('Updated At')->exceptOnForms(),
        ]);
    }
}
