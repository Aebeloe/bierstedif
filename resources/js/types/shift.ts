export interface PublicShift {
    id: number;
    name: string;
    description: string | null;
    category: string | null;
    start_time: string;
    end_time: string;
    total: number;
    claimed: number;
    available: number;
    claimed_names: string[];
}
