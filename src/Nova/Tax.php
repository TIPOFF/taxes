<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Locations\Nova\Location;
use Tipoff\Support\Nova\BaseResource;
use Tipoff\Taxes\Enum\TaxCode;
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
            Text::make('Tax Code')->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('Name')->required(),
            Slug::make('Slug')->from('Name'),
            Number::make('Percent'),
            Text::make('Title'),
            Select::make('Tax Code')->options([
                TaxCode::BOOKING => 'Booking',
                TaxCode::PRODUCT => 'Product',
            ])->required(),

            new Panel('Data Fields', $this->dataFields()),

            BelongsTo::make('Location', 'location', Location::class),
            nova('booking') ? HasMany::make('Bookings', 'bookings', nova('booking')) : null,
        ]);
    }

    protected function dataFields(): array
    {
        return array_merge(
            parent::dataFields(),
            $this->creatorDataFields(),
            $this->updaterDataFields(),
        );
    }
}
