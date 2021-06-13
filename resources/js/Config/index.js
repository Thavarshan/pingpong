import Repository from './Repository';
import items from './items.json';

/**
 * Get config value of given key.
 *
 * @param   {Any}  key
 * @param   {Any}  defaultValue
 *
 * @return  {Any}
 */
export default function config(key, defaultValue = null) {
    const repository = new Repository(items);

    return repository.get(key, defaultValue);
}
