import moment from 'moment';

/**
 * Mutate given timestamp to human readable form.
 *
 * @param {String}
 *
 * @return {String}
 */
export default function diffForHumans(timestamp) {
    return moment(timestamp).fromNow();
}
