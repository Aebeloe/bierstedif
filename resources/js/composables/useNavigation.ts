export interface NavChild {
    label: string;
    href: string;
    external?: boolean;
}

export interface NavItem {
    label: string;
    href: string;
    children?: NavChild[];
}

export function useNavigation(): NavItem[] {
    return [
        {
            label: 'Udvalg',
            href: '#',
            children: [
                { label: 'Moseløbet', href: '/udvalg/moselobet' },
                { label: 'Biersted Nyt', href: '/udvalg/biersted-nyt' },
                { label: 'TUEN', href: '/udvalg/tuen' },
                { label: 'Kulturudvalget', href: '/udvalg/kulturudvalget' },
                { label: 'Hjælperbank', href: '/udvalg/hjaelperbank' },
                { label: 'Booking', href: 'https://bifvk.dk', external: true },
            ],
        },
        {
            label: 'Tilmeldinger',
            href: '#',
            children: [
                { label: 'Prøvetræning', href: '/tilmeldinger/proevetraening' },
                { label: 'Badminton', href: '/tilmeldinger/badminton' },
                { label: 'Fodbold', href: '/tilmeldinger/fodbold' },
                { label: 'Gymnastik', href: '/tilmeldinger/gymnastik' },
                { label: 'Håndbold', href: '/tilmeldinger/haandbold' },
                { label: 'Floorball', href: '/tilmeldinger/floorball' },
                { label: 'Dart', href: '/tilmeldinger/dart' },
                { label: 'Esport', href: '/tilmeldinger/esport' },
                { label: 'Familiemedlemskab', href: '/tilmeldinger/familiemedlemskab' },
                { label: 'Ungdomsklub', href: '/tilmeldinger/ungdomsklub' },
                { label: 'Øvrige Hold', href: '/tilmeldinger/oevrige-hold' },
            ],
        },
        { label: 'Om Foreningen', href: '/om-foreningen' },
        { label: 'Kalender', href: '/kalender' },
        { label: 'Kontakt', href: '/kontakt' },
        { label: 'Klubdragt', href: '/klubdragt' },
        { label: 'Sponsorer', href: '/sponsorer' },
    ];
}
