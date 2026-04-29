import sqlite3
import pandas as pd
import time

def monitor_protocol():
    # Connect to your Laravel database
    conn = sqlite3.connect('../database/database.sqlite')
    
    print("🤖 BroaderAgent Python Core: Online and Monitoring...")

    while True:
        try:
            # 1. SPAM DETECTION LOGIC
            query = "SELECT id, bcid_id, content FROM broadcasts"
            df = pd.read_sql_query(query, conn)
            
            for index, row in df.iterrows():
                # If a user posts the same thing twice, flag them
                duplicates = df[df['content'] == row['content']]
                if len(duplicates) > 1:
                    print(f"⚠️ SPAM ALERT: BCID-{row['bcid_id']} repeated content: '{row['content']}'")

            # 2. MONITOR INTERACTIONS (Likes, Rebroadcasts, etc.)
            interaction_query = """
                SELECT type, COUNT(*) as count 
                FROM interactions 
                GROUP BY type
            """
            int_df = pd.read_sql_query(interaction_query, conn)
            
            print("\n--- Protocol Activity Report ---")
            if int_df.empty:
                print("📊 No interactions recorded yet.")
            for _, row in int_df.iterrows():
                print(f"📊 Total {row['type']}s: {row['count']}")

            # 3. TREASURY MONITORING
            treasury_query = "SELECT SUM(amount) as total FROM bcids"
            treasury_df = pd.read_sql_query(treasury_query, conn)
            total_funds = treasury_df['total'].iloc[0] if treasury_df['total'].iloc[0] else 0
            print(f"💰 Treasury Watch: ${total_funds:.2f} currently secured.")
            
            print("--------------------------------")
            
        except Exception as e:
            print(f"❌ Error reading database: {e}")

        # Sleep for 10 seconds before next scan
        time.sleep(10)

if __name__ == "__main__":
    monitor_protocol()