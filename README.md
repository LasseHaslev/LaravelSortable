# lassehaslev/laravel-sortable
> Add sorting logic to your eloquent models

## Install
Run
```
composer require lassehaslev/laravel-sortable
```

Create your package and add the following line to ```providers``` in ```config/app.php``` 
```
    LasseHaslev\LaravelSortable\Providers\ServiceProvider::class,
```

## Usage
Include ```LasseHaslev\LaravelSortable\Traits\Sortable``` to models to make it sortable
```php
<?

class TestObject extends Illuminate\Database\Eloquent\Model {
    use LasseHaslev\LaravelSortable\Traits\Sortable;
}
```

You can also overwrite the column name that holds the sorting value
```php
<?

class TestObject extends Illuminate\Database\Eloquent\Model {
    use LasseHaslev\LaravelSortable\Traits\Sortable;
    protected $sortingColumnName = 'order'; // Default
}
```

#### Api
```php
// Get sorted list
$sortedCollection = Object::sorted()->all();

// Move object to position
Object::moveTo( $objectToMove, $position );

// Move to front
Object::moveToFront( $objectToMove );

// Move to back
Object::moveToBack( $objectToMove );

// Increment position by one
Object::incrementPosition( $objectToMove );

// Decrement position by one
Object::decrementPosition( $objectToMove );
```



## Development

```bash
composer install
yarn
```


#### Runing tests
``` bash
# Run one time
npm run test

# Automaticly run test on changes
npm run dev
```
